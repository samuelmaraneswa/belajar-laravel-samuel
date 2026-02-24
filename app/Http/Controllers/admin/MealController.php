<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\MealGoal;
use Illuminate\Http\Request;

class MealController extends Controller
{
  public function index(Request $request)
  {
    $categorySlug = $request->query('category');
    $goalSlug     = $request->query('goal');

    // Cards data
    $categories = MealCategory::withCount('meals')->get();
    $goals      = MealGoal::withCount('meals')->get();

    // Meals query
    $mealsQuery = Meal::query()
      ->with(['category', 'goal']);

    if ($categorySlug) {
      $mealsQuery->whereHas('category', function ($q) use ($categorySlug) {
        $q->where('slug', $categorySlug);
      });
    }

    if ($goalSlug) {
      $mealsQuery->whereHas('goal', function ($q) use ($goalSlug) {
        $q->where('slug', $goalSlug);
      });
    }

    $meals = $mealsQuery->latest()->paginate(9);

    return view('admin.meals.index', compact(
      'categories',
      'goals',
      'meals'
    ));
  }
}
