<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MealGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MealGoalController extends Controller
{
  public function index()
  {
    $goals = MealGoal::latest()->get();

    return view('admin.meals.goals.index', compact('goals'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $goal = MealGoal::create([
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
    ]);

    return response()->json([
      'message' => 'Goal berhasil ditambahkan',
      'html' => view(
        'admin.meals.goals._row',
        ['goal' => $goal]
      )->render(),
    ], 201);
  }

  public function update(Request $request, MealGoal $mealGoal)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $mealGoal->update([
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
    ]);

    return response()->json([
      'message' => 'Goal berhasil diupdate',
      'html' => view(
        'admin.meals.goals._row',
        ['goal' => $mealGoal]
      )->render(),
    ]);
  }

  public function destroy(MealGoal $mealGoal)
  {
    $mealGoal->delete();

    return response()->json([
      'message' => 'Goal berhasil dihapus',
    ]);
  }
}
