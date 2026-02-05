<?php

namespace App\Http\Controllers;

use App\Models\Muscle;
use App\Models\Workout;
use App\Models\WorkoutCategory;
use App\Services\WorkoutCalculator;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class WorkoutController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->query('search');

    $workouts = Workout::with('category')
        ->when($search, function($q) use ($search){
          $q->where('title', 'like', "%{$search}%");})
        ->latest()
        ->paginate(20)
        ->withQueryString();
    
    return view('workouts.index', compact('workouts'));
  }

  public function show(Workout $workout)
  {
    // ambil primary muscle slug
    $primaryMuscles = $workout->muscles
      ->where('pivot.role', 'primary')
      ->pluck('id');

    // similar workouts (exclude current)
    $similarWorkouts = Workout::with(['category', 'muscles'])
      ->whereHas('muscles', function ($q) use ($primaryMuscles) {
        $q->whereIn('muscles.id', $primaryMuscles);
      })
      ->where('id', '!=', $workout->id)
      ->take(6)
      ->get();

    return view('workouts.show', compact(
      'workout',
      'similarWorkouts'
    ));
  }

  public function suggest(Request $request)
  {
    $q = trim($request->query('q'));

    if ($q === '') {
      return response()->json([]);
    }

    $titles = Workout::where('title', 'like', "%{$q}%")
      ->orderBy('title')
      ->limit(20)
      ->pluck('title')
      ->values(); // penting

    return response()->json($titles);
  }


  public function calculatePreview(Request $request, Workout $workout)
  {
    $data = $request->validate([
      'gender' => ['required', 'in:male,female'],
      'age'    => ['required', 'integer', 'min:1'],
      'weight' => ['required', 'numeric', 'min:1'],
      'height' => ['required', 'numeric', 'min:1'],
    ]);

    return response()->json([
      'levels' => WorkoutCalculator::calculate($data, $workout)
    ]);
  }
}