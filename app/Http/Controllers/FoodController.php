<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
  public function index()
  {
    return view('foods.index');
  }

  public function suggest(Request $request)
  {
    $q = trim($request->query('q'));

    if ($q === '') {
      return response()->json([]);
    }

    return Food::where('is_active', true)
      ->where('name', 'like', "%{$q}%")
      ->orderBy('name')
      ->limit(20)
      ->get(['name', 'slug']);   
  }

  public function data($slug)
  {
    $food = Food::with('nutrition')
      ->where('slug', $slug)
      ->firstOrFail();

    return response()->json($food);
  }
}
