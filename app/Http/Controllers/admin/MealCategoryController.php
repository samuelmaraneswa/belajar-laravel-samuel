<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MealCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MealCategoryController extends Controller
{
  public function index()
  {
    $categories = MealCategory::latest()->get();

    return view('admin.meals.categories.index', compact('categories'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $category = MealCategory::create([
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
    ]);

    return response()->json([
      'message' => 'Meal category berhasil ditambahkan',
      'html' => view(
        'admin.meals.categories._row',
        ['category' => $category]
      )->render(),
    ], 201);
  }

  public function update(Request $request, MealCategory $mealCategory)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $mealCategory->update([
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
    ]);

    return response()->json([
      'message' => 'Meal category berhasil diupdate',
      'html' => view(
        'admin.meals.categories._row',
        ['category' => $mealCategory]
      )->render(),
    ]);
  }

  public function destroy(MealCategory $mealCategory)
  {
    $mealCategory->delete();

    return response()->json([
      'message' => 'Meal category berhasil dihapus',
    ]);
  }
}
