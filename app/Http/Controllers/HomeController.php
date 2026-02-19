<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BlogPost;
use App\Models\Food;
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

    $foods = Food::with('nutrition')
      ->where('is_active', true)
      ->latest()
      ->take(3)
      ->get();

    $latestArticles = Article::where('status', 'published')
      ->latest()
      ->take(3)
      ->get();

    return view('home', compact('workouts', 'latestPosts', 'foods', 'latestArticles'));
  }
}
