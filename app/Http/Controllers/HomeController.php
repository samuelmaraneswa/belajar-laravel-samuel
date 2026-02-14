<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Workout;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $workouts = Workout::with(['category', 'muscles'])
      ->latest()
      ->take(3) // 3 atau 4, bebas
      ->get();

    $latestPosts = BlogPost::latest()
      ->take(3)
      ->get();

    return view('home', compact('workouts', 'latestPosts'));
  }
}
