<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\BlogPost;
use App\Models\Food;
use App\Models\Meal;
use App\Models\Program;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view('admin.dashboard', [
      'totalWorkouts'   => Workout::count(),
      'totalPrograms'   => Program::count(),
      'totalArticles'   => Article::count(),
      'totalUsers'      => User::count(),
      'totalMeals'      => Meal::count(),
      'totalFoods'      => Food::count(),
      'totalPosts'      => BlogPost::count(),
    ]);
  }
}
