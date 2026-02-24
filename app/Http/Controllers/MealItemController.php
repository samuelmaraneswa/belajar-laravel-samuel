<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealItemController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->search;
    $category = $request->category;
    $goal = $request->goal;

    $meals = Meal::with(['category', 'goal'])
      ->when(
        $search,
        fn($q) =>
        $q->where('title', 'like', "%{$search}%")
      )
      ->when(
        $category,
        fn($q) =>
        $q->whereHas(
          'category',
          fn($q2) =>
          $q2->where('slug', $category)
        )
      )
      ->when(
        $goal,
        fn($q) =>
        $q->whereHas(
          'goal',
          fn($q2) =>
          $q2->where('slug', $goal)
        )
      )
      ->latest()
      ->paginate(9)
      ->withQueryString();

    return view('meals.items.index', compact('meals'));
  }

  public function show(Request $request, Meal $meal)
  {
    $category = $request->query('category');
    $goal     = $request->query('goal');

    $similarMeals = Meal::with(['category', 'goal'])
      ->where('id', '!=', $meal->id)

      // Jika datang dari category card
      ->when($category, function ($q) use ($category) {
        $q->whereHas('category', function ($c) use ($category) {
          $c->where('slug', $category);
        });
      })

      // Jika datang dari goal card
      ->when($goal, function ($q) use ($goal) {
        $q->whereHas('goal', function ($g) use ($goal) {
          $g->where('slug', $goal);
        });
      })

      ->latest()
      ->take(6)
      ->get();

    return view('meals.items.show', compact('meal', 'similarMeals'));
  }

  public function suggest(Request $request)
  {
    $q        = trim($request->query('q'));
    $category = $request->query('category');
    $goal     = $request->query('goal');

    if ($q === '') {
      return response()->json([]);
    }

    $query = Meal::query();

    // search title
    $query->where('title', 'like', "%{$q}%");

    // filter category
    if ($category) {
      $query->whereHas('category', function ($c) use ($category) {
        $c->where('slug', $category);
      });
    }

    // filter goal
    if ($goal) {
      $query->whereHas('goal', function ($g) use ($goal) {
        $g->where('slug', $goal);
      });
    }

    $titles = $query->orderBy('title')
      ->limit(20)
      ->pluck('title')
      ->values();

    return response()->json($titles);
  }
}
