<?php

namespace App\Http\Controllers;

use App\Models\Muscle;
use App\Models\Workout;
use App\Models\WorkoutCategory;
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
        ->paginate(3)
        ->withQueryString();
    
    return view('workouts.index', compact('workouts'));
  }

  public function suggest(Request $request)
  {
    $q = $request->query('q');

    if(!$q){
      return response()->json([]);
    }

    return Workout::where('title', 'like', "%{$q}%")->limit(3)->pluck('title');
  }

  public function show(Workout $workout, Request $request)
  {
    return view('workouts.show', compact('workout'));
  }

  public function adminIndex()
  {
    $workouts = Workout::with('category')
      ->latest()
      ->paginate(10);

    return view('admin.workouts.index', compact('workouts'));
  }
}