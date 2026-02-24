<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\MealGoal;
use Illuminate\Http\Request;

class MealController extends Controller
{
  public function index()
  {
    $categories = MealCategory::withCount('meals')->get();
    $goals = MealGoal::withCount('meals')->get();

    return view('meals.index', compact('categories', 'goals'));
  }
}
