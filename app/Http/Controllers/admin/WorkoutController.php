<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Muscle;
use App\Models\Workout;
use App\Models\WorkoutCategory;
use App\Models\WorkoutContext;
use App\Models\WorkoutInstruction;
use App\Services\WorkoutCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Str as SupportStr;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class WorkoutController extends Controller
{
  public function index()
  {
    $contexts = WorkoutContext::withCount('workouts')->get();

    // total semua workout (untuk "All Workouts")
    $totalWorkouts = Workout::count();

    return view('admin.workouts.index', compact(
      'contexts',
      'totalWorkouts'
    ));
  }

  public function create() 
  {
    return view('admin.workouts.create', [
      'categories' => WorkoutCategory::all(),
      'muscles' => Muscle::all(),
      'contexts' => WorkoutContext::all(),
      'equipments' => Equipment::all(),
    ]);
  }

  public function store(Request $request)
  {
    $slug = SupportStr::slug($request->title);
    $request->merge(['slug' => $slug]);

    $validated = $request->validate([
      'title' => 'required|min:3',
      'slug'  => 'unique:workouts,slug',
      'workout_category_id' => 'required|exists:workout_categories,id',

      'type' => ['required', 'in:machine,bodyweight'],

      'description' => 'required|min:5',

      // context
      'contexts' => 'required|array',
      'contexts.*' => 'exists:workout_contexts,id',

      // equipments
      'equipments' => 'nullable|array',
      'equipments.*' => 'exists:equipments,id',

      // muscles
      'primary_muscles' => 'required|array',
      'primary_muscles.*' => 'exists:muscles,id',

      'secondary_muscles' => 'nullable|array',
      'secondary_muscles.*' => 'exists:muscles,id',

      // instructions
      'instructions' => 'required|array',
      'instructions.*' => 'required|string|min:1',

      // media
      'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
      'gif'   => 'nullable|mimes:gif|max:10240',

      // optional video
      'video' => 'nullable|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:51200',

      'difficulty' => 'nullable|in:beginner,intermediate,advanced',
      'movement' => 'required|in:compound,isolation',
      'difficulty_factor' => 'nullable|numeric|min:0.2|max:1.5',
    ],
    [
      'slug.unique' => 'Workout dengan judul ini sudah ada',
    ]);

    $validated['slug'] = SupportStr::slug($validated['title']);

    /** =====================
     *  IMAGE UPLOAD
     * ===================== */
    $imageFile = $request->file('image');
    $imagePath = $imageFile->store('workouts/images', 'public');

    $validated['image'] = $imagePath;
    $validated['image_thumb'] = null;

    $manager = new ImageManager(new Driver());

    // $image = $manager->read(
    //   storage_path('app/public/' . $imagePath)
    // );
    $image = $manager->read(
      storage_path('app/public/' . $imagePath)
    )->orient();

    $thumbPath = 'workouts/images/thumbs/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

    // $image->cover(800, 500)->save(
    //   storage_path('app/public/' . $thumbPath)
    // );
    // $image
    //   ->resize(800, null, function ($constraint) {
    //     $constraint->aspectRatio(); // jaga rasio asli
    //     $constraint->upsize();      // jangan diperbesar kalau kecil
    //   })
    //   ->toWebp(75) // kompres, 75 = sweet spot
    //   ->save(
    //     storage_path('app/public/' . $thumbPath)
    //   );
    $thumb = clone $image;
    $image
      ->toWebp(70)
      ->save(storage_path('app/public/' . $thumbPath));

    $validated['image_thumb'] = $thumbPath;

    /** =====================
     *  GIF UPLOAD
     * ===================== */
    if ($request->hasFile('gif')) {
      $validated['gif'] = $request->file('gif')
        ->store('workouts/gifs', 'public');
    } else {
      $validated['gif'] = null;
    }

    /** =====================
     *  VIDEO UPLOAD
     * ===================== */
    if($request->hasFile('video')){
      $validated['video'] = $request->file('video')
        ->store('workouts/videos', 'public');
    }else{
      $validated['video'] = null;
    }

    if ($validated['type'] === 'bodyweight') {
      $validated['difficulty_factor'] = 1;
    }

    /** =====================
     *  SAVE WORKOUT
     * ===================== */
    $workout = Workout::create($validated);

    /** =====================
     *  CONTEXT RELATION
     * ===================== */
    $workout->contexts()->sync($validated['contexts']);

    /** =====================
     *  EQUIPMENT RELATION
     * ===================== */
    if (!empty($validated['equipments'] ?? [])) {
      $workout->equipments()->sync($validated['equipments']);
    }

    /** =====================
     *  MUSCLE RELATION
     * ===================== */
    foreach ($validated['primary_muscles'] as $muscleId) {
      $workout->muscles()->attach($muscleId, [
        'role' => 'primary',
      ]);
    }

    foreach ($validated['secondary_muscles'] ?? [] as $muscleId) {
      $workout->muscles()->attach($muscleId, [
        'role' => 'secondary',
      ]);
    }

    /** =====================
     *  INSTRUCTIONS (STEP-BY-STEP)
     * ===================== */
    foreach ($validated['instructions'] as $index => $text) {
      WorkoutInstruction::create([
        'workout_id' => $workout->id,
        'step'       => $index + 1,
        'instruction' => $text,
      ]);
    }

    return redirect('/admin/workouts/list')
      ->with('success', 'Workout berhasil disimpan');
  }

  public function suggest(Request $request)
  {
    $q = $request->query('q');

    if(!$q){
      return response()->json([]);
    }

    return Workout::where('title', 'like', "%{$q}%")->limit(5)->pluck('title');
  }

  public function show($slug)
  {
    $workout = Workout::where('slug', $slug)
      ->with(['contexts', 'equipments', 'muscles', 'instructions'])
      ->firstOrFail();

    // ambil primary muscle ID dari workout ini
    $primaryMuscleIds = $workout->muscles
      ->where('pivot.role', 'primary')
      ->pluck('id');

    // ambil similar workouts (primary muscle sama)
    $similarWorkouts = Workout::where('id', '!=', $workout->id)
      ->whereHas('muscles', function ($q) use ($primaryMuscleIds) {
        $q->whereIn('muscles.id', $primaryMuscleIds)
          ->where('muscle_workout.role', 'primary');
      })
      ->inRandomOrder()
      ->limit(8)
      ->get();

    return view('admin.workouts.show', compact('workout','similarWorkouts'));
  }
  
  public function list(Request $request)
  {
    $context = $request->query('context'); // gym | home | calisthenics | null
    $search  = $request->query('search');

    $muscles = [
      ['name' => 'Chest', 'slug' => 'chest'],
      ['name' => 'Back', 'slug' => 'back'],
      ['name' => 'Biceps', 'slug' => 'biceps'],
      ['name' => 'Triceps', 'slug' => 'triceps'],
      ['name' => 'Shoulders', 'slug' => 'shoulders'],
      ['name' => 'Core', 'slug' => 'core'],
      ['name' => 'Quads', 'slug' => 'quads'],
      ['name' => 'Hamstring', 'slug' => 'hamstring'],
      ['name' => 'Obliques', 'slug' => 'obliques'],
      ['name' => 'Trapezius', 'slug' => 'trapezius'],
      ['name' => 'Forearms', 'slug' => 'forearms'],
      ['name' => 'Calves', 'slug' => 'calves'],
      ['name' => 'Abductors', 'slug' => 'abductors'],
      ['name' => 'Adductors', 'slug' => 'adductors'],
      ['name' => 'Necks', 'slug' => 'necks'],
      ['name' => 'Glutes', 'slug' => 'glutes'],
      ['name' => 'Lower Back', 'slug' => 'lower-back'],
    ];

    $workouts = Workout::with('category')
      ->when($context, function ($q) use ($context) {
        $q->whereHas(
          'contexts',
          fn($q2) =>
          $q2->where('slug', $context)
        );
      })
      ->when(
        $search,
        fn($q) =>
        $q->where('title', 'like', "%{$search}%")
      )
      ->latest()
      ->paginate(5);

    return view('admin.workouts.list', compact(
      'workouts',
      'muscles',
      'context'
    ));
  }

  public function calculate(Request $request, Workout $workout)
  {
    $data = $request->validate([
      'gender' => ['required', 'in:male,female'],
      'age'    => ['required', 'integer', 'min:1'],
      'weight' => ['required', 'numeric', 'min:1'],
      'height' => ['required', 'numeric', 'min:1'],
    ]);

    return response()->json(['levels' => WorkoutCalculator::calculate($data, $workout)]);
  }

  public function search(Request $request)
  {
    $search = $request->query('search');

    $workouts = Workout::with('category')
      ->when(
        $search,
        fn($q) =>
        $q->where('title', 'like', "%{$search}%")
      )
      ->get();

    return view('admin.workouts._cards', compact('workouts'));
  }
}