<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealItemController extends Controller
{
  public function index(Request $request)
  {
    $query = Meal::with(['category', 'goal']);

    // Search by title
    if ($request->filled('search')) {
      $query->where('title', 'like', '%' . $request->search . '%');
    }

    $meals = $query->latest()->paginate(30);

    // AJAX request (for table refresh)
    if ($request->ajax()) {
      return response()->json([
        'html' => view('admin.meals.items.partials._table', compact('meals'))->render(),
        'pagination' => [
          'page' => $meals->currentPage(),
          'last' => $meals->lastPage(),
        ]
      ]);
    }

    return view('admin.meals.items.index', compact('meals'));
  }

  public function create()
  {
    $categories = \App\Models\MealCategory::orderBy('name')->get();
    $goals = \App\Models\MealGoal::orderBy('name')->get();
    $foods = \App\Models\Food::orderBy('name')->get();

    return view('admin.meals.items.partials._form', [
      'meal' => null,
      'categories' => $categories,
      'goals' => $goals,
      'foods' => $foods,
    ]);
  }
}
