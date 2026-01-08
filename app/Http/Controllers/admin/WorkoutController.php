<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Muscle;
use App\Models\Workout;
use App\Models\WorkoutCategory;
use App\Services\WorkoutCalculator;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class WorkoutController extends Controller
{
  public function adminIndex(Request $request)
  {
    $search = $request->query('search');

    $workouts = Workout::with('category')
        ->when($search, function($q) use ($search){
          $q->where('title', 'like', "%{$search}%");})
        ->latest()
        ->get();
    
    return view('workouts.index', compact('workouts'));
  }
 
  public function create() 
  {
    return view('admin.workouts.create', [
      'categories' => WorkoutCategory::all(),
      'muscles' => Muscle::all(),
    ]);
  }

  // public function store(Request $request)
  // {
  //   $validated = $request->validate([
  //     'title' => 'required|min:3',
  //     'workout_category_id' => 'required|exists:workout_categories,id',
  //     'type' => ['required', 'in:machine,bodyweight'],
  //     'description' => 'required|min:5',
  //     'primary_muscles' => 'required|array',
  //     'primary_muscles.*' => 'exists:muscles,id',
  //     'secondary_muscles' => 'nullable|array',
  //     'secondary_muscles.*' => 'exists:muscles,id',
  //     'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
  //     'video' => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:51200'
  //   ]);

  //   $imagePath = $request->file('image')->store('workouts/images', 'public');

  //   $manager = new ImageManager(new Driver());
  //   $image = $manager->read(storage_path('app/public/' . $imagePath));

  //   $thumbPath = 'workouts/images/thumbs/' . basename($imagePath);
  //   $image->cover(800, 500)->save(storage_path('app/public/' . $thumbPath));

  //   $validated['image'] = $imagePath;
  //   $validated['image_thumb'] = $thumbPath;

  //   $validated['video'] = $request->file('video')->store('workouts/videos', 'public');

  //   $workout = Workout::create($validated);

  //   foreach ($request->primary_muscles ?? [] as $muscleId) {
  //     $workout->muscles()->attach($muscleId, [
  //       'role' => 'primary'
  //     ]);
  //   }

  //   // Secondary muscle
  //   foreach ($request->secondary_muscles ?? [] as $muscleId) {
  //     $workout->muscles()->attach($muscleId, [
  //       'role' => 'secondary'
  //     ]);
  //   }

  //   return redirect('/admin/workouts')
  //         ->with('success', 'Workout berhasil disimpan');
  // }
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|min:3',
      'workout_category_id' => 'required|exists:workout_categories,id',
      'type' => ['required', 'in:machine,bodyweight'],
      'description' => 'required|min:5',
      'primary_muscles' => 'required|array',
      'primary_muscles.*' => 'exists:muscles,id',
      'secondary_muscles' => 'nullable|array',
      'secondary_muscles.*' => 'exists:muscles,id',
      'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
      'video' => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:51200',
    ]);

    /** =====================
     *  IMAGE UPLOAD
     * ===================== */
    $imageFile = $request->file('image');
    $imagePath = $imageFile->store('workouts/images', 'public');

    $validated['image'] = $imagePath;
    $validated['image_thumb'] = null;

    // ⚠️ Jangan proses GIF (biar animasi aman)
    if ($imageFile->getClientOriginalExtension() !== 'gif') {
      $manager = new ImageManager(new Driver());

      $image = $manager->read(
        storage_path('app/public/' . $imagePath)
      );

      $thumbPath = 'workouts/images/thumbs/' . basename($imagePath);

      $image->cover(800, 500)->save(
        storage_path('app/public/' . $thumbPath)
      );

      $validated['image_thumb'] = $thumbPath;
    }

    /** =====================
     *  VIDEO UPLOAD
     * ===================== */
    $validated['video'] = $request->file('video')
      ->store('workouts/videos', 'public');

    /** =====================
     *  SAVE WORKOUT
     * ===================== */
    $workout = Workout::create($validated);

    /** =====================
     *  MUSCLE RELATION
     * ===================== */
    foreach ($request->primary_muscles as $muscleId) {
      $workout->muscles()->attach($muscleId, [
        'role' => 'primary',
      ]);
    }

    foreach ($request->secondary_muscles ?? [] as $muscleId) {
      $workout->muscles()->attach($muscleId, [
        'role' => 'secondary',
      ]);
    }

    return redirect('/admin/workouts')
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

  public function show(Workout $workout, Request $request)
  {
    return view('admin.workouts.show', compact('workout'));
  }

  public function index()
  {
    $search = request('search');

    $workouts = Workout::with('category')
      ->when($search, function ($q) use ($search) {
        $q->where('title', 'like', "%{$search}%");
      })
      ->latest()
      ->get();

    return view('admin.workouts.index', compact('workouts'));
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