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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str as SupportStr;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class WorkoutController extends Controller
{
  public function index()
  {
    $contexts = WorkoutContext::withCount('workouts')->orderBy('name')->get();

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

      'type' => ['required', 'in:machine,bodyweight,assisted,resistance-band'],

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
      'difficulty_factor' => 'required|numeric|min:0.2|max:1.5',
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

    $image = $manager->read(
      storage_path('app/public/' . $imagePath)
    )->orient();

    $thumbPath = 'workouts/images/thumbs/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

    $thumb = clone $image;

    $thumb
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

  // public function suggest(Request $request)
  // {
  //   $q = $request->query('q');
  //   $context = $request->query('context');

  //   if (!$q) {
  //     return response()->json([]);
  //   }

  //   return Workout::when($context, function ($query) use ($context) {
  //     $query->whereHas(
  //       'contexts',
  //       fn($c) =>
  //       $c->where('slug', $context)
  //     );
  //   })
  //     ->where('title', 'like', "%{$q}%")
  //     ->limit(20)
  //     ->pluck('title');
  // }

  public function suggest(Request $request)
  {
    $q       = $request->query('q');
    $context = $request->query('context');
    $muscle  = $request->query('muscle');

    if (!$q) {
      return response()->json([]);
    }

    return Workout::when($context, function ($query) use ($context) {
      $query->whereHas(
        'contexts',
        fn($c) => $c->where('slug', $context)
      );
    })
      ->when($muscle, function ($query) use ($muscle) {
        $query->whereHas(
          'muscles',
          fn($m) => $m->where('slug', $muscle)
        );
      })
      ->where('title', 'like', "%{$q}%")
      ->limit(20)
      ->pluck('title');
  }

  public function show(Request $request, $slug)
  {
    $context = $request->query('context'); // home-workout | gym-workout

    $workout = Workout::where('slug', $slug)
      ->with(['contexts', 'equipments', 'muscles', 'instructions'])
      ->firstOrFail();

    $primaryMuscleIds = $workout->muscles
      ->where('pivot.role', 'primary')
      ->pluck('id');

    $similarWorkouts = Workout::where('id', '!=', $workout->id)
      ->whereHas('muscles', function ($q) use ($primaryMuscleIds) {
        $q->whereIn('muscles.id', $primaryMuscleIds)
          ->where('muscle_workout.role', 'primary');
      })
      ->when($context, function ($q) use ($context) {
        $q->whereHas('contexts', fn($c) => $c->where('slug', $context));
      })
      ->inRandomOrder()
      ->limit(9)
      ->get();

    return view('admin.workouts.show', compact(
      'workout',
      'similarWorkouts',
      'context'
    ));
  }

  public function list(Request $request)
  {
    $context = $request->query('context');
    $muscle  = $request->query('muscle');

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

    return view('admin.workouts.list', compact(
      'muscles',
      'context',
      'muscle'
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

  public function edit(Workout $workout)
  {
    $workout->load('contexts', 'equipments', 'muscles');

    return view('admin.workouts.edit', [
      'workout'    => $workout,
      'categories' => WorkoutCategory::all(),
      'contexts'   => WorkoutContext::all(),
      'equipments' => Equipment::all(),
      'muscles'    => Muscle::all(),
    ]);
  }


  public function update(Request $request, Workout $workout)
  {
    $slug = SupportStr::slug($request->title);
    $request->merge(['slug' => $slug]);

    $validated = $request->validate([
      'title' => 'required|min:3',

      'slug' => [
        'required',
        Rule::unique('workouts', 'slug')->ignore($workout->id),
      ],

      'workout_category_id' => 'required|exists:workout_categories,id',

      'type' => ['required', 'in:machine,bodyweight,assisted,resistance-band'],

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

      // media (BEDA UTAMA)
      'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
      'gif'   => 'nullable|mimes:gif|max:10240',
      'video' => 'nullable|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:51200',

      'difficulty' => 'nullable|in:beginner,intermediate,advanced',
      'movement' => 'required|in:compound,isolation',
      'difficulty_factor' => 'required|numeric|min:0.2|max:1.5',
    ], [
      'slug.unique' => 'Workout dengan judul ini sudah ada',
    ]);

    // IMAGE UPDATE
    if ($request->hasFile('image')) {

      // 1️⃣ Hapus image lama
      if ($workout->image && Storage::disk('public')->exists($workout->image)) {
        Storage::disk('public')->delete($workout->image);
      }

      // 2️⃣ Hapus thumb lama
      if ($workout->image_thumb && Storage::disk('public')->exists($workout->image_thumb)) {
        Storage::disk('public')->delete($workout->image_thumb);
      }

      // 3️⃣ Simpan image baru
      $imagePath = $request->file('image')
        ->store('workouts/images', 'public');

      $validated['image'] = $imagePath;

      // 4️⃣ Generate thumb baru
      $manager = new ImageManager(new Driver());

      $image = $manager
        ->read(storage_path('app/public/' . $imagePath))
        ->orient();

      $thumbPath = 'workouts/images/thumbs/' .
        pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

      (clone $image)
        ->toWebp(70)
        ->save(storage_path('app/public/' . $thumbPath));

      $validated['image_thumb'] = $thumbPath;
    }

    // GIF UPDATE
    if ($request->hasFile('gif')) {

      // hapus gif lama
      if ($workout->gif && Storage::disk('public')->exists($workout->gif)) {
        Storage::disk('public')->delete($workout->gif);
      }

      // simpan gif baru
      $validated['gif'] = $request->file('gif')
        ->store('workouts/gifs', 'public');
    }

    // VIDEO UPDATE
    if ($request->hasFile('video')) {

      // hapus video lama
      if ($workout->video && Storage::disk('public')->exists($workout->video)) {
        Storage::disk('public')->delete($workout->video);
      }

      // simpan video baru
      $validated['video'] = $request->file('video')
        ->store('workouts/videos', 'public');
    }

    // RULE KHUSUS
    if ($validated['type'] === 'bodyweight') {
      $validated['difficulty_factor'] = 1;
    }

    // UPDATE DATA UTAMA
    $workout->update([
      'title'               => $validated['title'],
      'slug'                => $validated['slug'],
      'workout_category_id' => $validated['workout_category_id'],
      'type'                => $validated['type'],
      'movement'            => $validated['movement'],
      'difficulty'          => $validated['difficulty'] ?? null,
      'difficulty_factor'   => $validated['difficulty_factor'] ?? null,
      'description'         => $validated['description'],

      // media (pakai nilai baru jika ada, fallback ke lama)
      'image'        => $validated['image'] ?? $workout->image,
      'image_thumb'  => $validated['image_thumb'] ?? $workout->image_thumb,
      'gif'          => $validated['gif'] ?? $workout->gif,
      'video'        => $validated['video'] ?? $workout->video,
    ]);

    /** =====================
     *  CONTEXT RELATION
     * ===================== */
    $workout->contexts()->sync($validated['contexts']);

    /** =====================
     *  EQUIPMENT RELATION
     * ===================== */
    $workout->equipments()->sync($validated['equipments'] ?? []);

    /** =====================
     *  MUSCLE RELATION
     * ===================== */
    $workout->muscles()->detach();

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
     *  INSTRUCTIONS
     * ===================== */
    $workout->instructions()->delete();

    foreach ($validated['instructions'] as $index => $text) {
        WorkoutInstruction::create([
            'workout_id' => $workout->id,
            'step'       => $index + 1,
            'instruction'=> $text,
        ]);
    }

    return redirect('/admin/workouts/list')
        ->with('success', 'Workout berhasil diperbarui');
  }

  public function destroy(Workout $workout)
  {
    // 🔴 HAPUS IMAGE
    if ($workout->image && Storage::disk('public')->exists($workout->image)) {
      Storage::disk('public')->delete($workout->image);
    }

    if ($workout->image_thumb && Storage::disk('public')->exists($workout->image_thumb)) {
      Storage::disk('public')->delete($workout->image_thumb);
    }

    // 🔴 HAPUS GIF
    if ($workout->gif && Storage::disk('public')->exists($workout->gif)) {
      Storage::disk('public')->delete($workout->gif);
    }

    // 🔴 HAPUS VIDEO
    if ($workout->video && Storage::disk('public')->exists($workout->video)) {
      Storage::disk('public')->delete($workout->video);
    }

    // 🔴 HAPUS RELATION (AMAN UNTUK PIVOT)
    $workout->contexts()->detach();
    $workout->equipments()->detach();
    $workout->muscles()->detach();

    // 🔴 HAPUS INSTRUCTIONS
    $workout->instructions()->delete();

    // 🔥 HAPUS DATA UTAMA
    $workout->delete();

    return redirect('/admin/workouts/list')
      ->with('success', 'Workout berhasil dihapus');
  }

  public function ajaxList(Request $request)
  {
    $context = $request->query('context');
    $search  = $request->query('search');
    $muscle  = $request->query('muscle');

    $workouts = Workout::with('category')
      ->when(
        $context,
        fn($q) =>
        $q->whereHas('contexts', fn($c) => $c->where('slug', $context))
      )
      ->when(
        $muscle,
        fn($q) =>
        $q->whereHas('muscles', fn($m) => $m->where('slug', $muscle))
      )
      ->when(
        $search,
        fn($q) =>
        $q->where('title', 'like', "%{$search}%")
      )
      ->latest()
      ->paginate(20);

    return response()->json([
      'html' => view('admin.workouts._cards', compact('workouts'))->render(),
      'pagination' => [
        'page' => $workouts->currentPage(),
        'last' => $workouts->lastPage(),
      ]
    ]);
  }
}