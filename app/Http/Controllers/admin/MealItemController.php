<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Goal;
use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\MealStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MealItemController extends Controller
{
  public function index(Request $request)
  {
    $query = Meal::with(['category', 'goal']);

    // 🔎 Filter category
    if ($request->filled('category')) {
      $query->whereHas('category', function ($q) use ($request) {
        $q->where('slug', $request->category);
      });
    }

    // 🎯 Filter goal
    if ($request->filled('goal')) {
      $query->whereHas('goal', function ($q) use ($request) {
        $q->where('slug', $request->goal);
      });
    }

    // 🔎 Search by title
    if ($request->filled('search')) {
      $query->where('title', 'like', '%' . $request->search . '%');
    }

    $meals = $query->latest()->paginate(30);

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

  public function store(Request $request)
  {
    $request->validate([
      'category_id' => 'required|exists:meal_categories,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'prep_time' => 'nullable|integer',
      'image' => 'nullable|image|max:2048',

      'ingredients' => 'required|array|min:1',
      'ingredients.*.food_id' => 'required|exists:foods,id',
      'ingredients.*.quantity' => 'required|numeric|min:0.01',

      'steps' => 'required|array|min:1',
      'steps.*.step_number' => 'required|integer|min:1',
      'steps.*.instruction' => 'required|string',
    ]);

    DB::beginTransaction();

    try {

      // =====================
      // UPLOAD IMAGE + THUMB
      // =====================
      $imagePath = null;

      if ($request->hasFile('image')) {

        $imageFile = $request->file('image');
        $imagePath = $imageFile->store('meals', 'public');

        $manager = new ImageManager(new Driver());

        $image = $manager->read(
          storage_path('app/public/' . $imagePath)
        )->orient();

        $thumbDirectory = storage_path('app/public/meals/thumb');

        if (!file_exists($thumbDirectory)) {
          mkdir($thumbDirectory, 0755, true);
        }

        $thumbPath = 'meals/thumb/' .
          pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

        $image->toWebp(70)
          ->save(storage_path('app/public/' . $thumbPath));
      }

      // =====================
      // CREATE MEAL
      // =====================
      $meal = Meal::create([
        'category_id' => $request->category_id,
        'goal_id' => $request->goal_id,
        'title' => $request->title,
        'slug' => Str::slug($request->title) . '-' . Str::random(5),
        'description' => $request->description,
        'prep_time' => $request->prep_time,
        'image' => $imagePath,
        'video_url' => $request->video_url,
      ]);

      // =====================
      // SAVE INGREDIENTS
      // =====================
      foreach ($request->ingredients as $ingredient) {

        if (empty($ingredient['food_id'])) continue;

        $meal->foods()->attach($ingredient['food_id'], [
          'quantity' => $ingredient['quantity'],
        ]);
      }

      // =====================
      // SAVE STEPS
      // =====================
      foreach ($request->steps as $step) {

        MealStep::create([
          'meal_id' => $meal->id,
          'step_number' => $step['step_number'],
          'instruction' => $step['instruction'],
        ]);
      }

      DB::commit();

      // =====================
      // REFRESH TABLE DATA
      // =====================
      $meals = Meal::with(['category', 'goal'])
        ->latest()
        ->paginate(30);

      return response()->json([
        'success' => true,
        'message' => 'Meal berhasil disimpan.',
        'html' => view(
          'admin.meals.items.partials._table',
          compact('meals')
        )->render()
      ]);
    } catch (\Exception $e) {

      DB::rollBack();

      return response()->json([
        'success' => false,
        'message' => 'Gagal menyimpan meal.'
      ], 500);
    }
  }

  public function show(Meal $meal)
  {
    $meal->load(['category', 'goal', 'foods', 'steps']);

    return view('admin.meals.items.partials._show', compact('meal'));
  }

  public function edit(Meal $meal)
  {
    $meal->load(['foods', 'steps']);

    $categories = MealCategory::all();
    $goals = Goal::all();
    $foods = Food::all();

    return view(
      'admin.meals.items.partials._form',
      compact('meal', 'categories', 'goals', 'foods')
    );
  }

  public function update(Request $request, Meal $meal)
  {
    $request->validate([
      'category_id' => 'required|exists:meal_categories,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'prep_time' => 'nullable|integer',
      'image' => 'nullable|image|max:2048',

      'ingredients' => 'required|array|min:1',
      'ingredients.*.food_id' => 'required|exists:foods,id',
      'ingredients.*.quantity' => 'required|numeric|min:0.01',

      'steps' => 'required|array|min:1',
      'steps.*.step_number' => 'required|integer|min:1',
      'steps.*.instruction' => 'required|string',
    ]);

    DB::beginTransaction();

    try {

      $imagePath = $meal->image;

      // =====================
      // REPLACE IMAGE
      // =====================
      if ($request->hasFile('image')) {

        if ($meal->image) {

          $oldImage = storage_path('app/public/' . $meal->image);
          if (file_exists($oldImage)) unlink($oldImage);

          $oldThumb = storage_path(
            'app/public/meals/thumb/' .
              pathinfo($meal->image, PATHINFO_FILENAME) . '.webp'
          );

          if (file_exists($oldThumb)) unlink($oldThumb);
        }

        $imageFile = $request->file('image');
        $imagePath = $imageFile->store('meals', 'public');

        $manager = new ImageManager(new Driver());

        $image = $manager->read(
          storage_path('app/public/' . $imagePath)
        )->orient();

        $thumbDirectory = storage_path('app/public/meals/thumb');
        if (!file_exists($thumbDirectory)) {
          mkdir($thumbDirectory, 0755, true);
        }

        $thumbPath = 'meals/thumb/' .
          pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

        $image->toWebp(70)
          ->save(storage_path('app/public/' . $thumbPath));
      }

      // =====================
      // UPDATE MEAL
      // =====================
      $meal->update([
        'category_id' => $request->category_id,
        'goal_id' => $request->goal_id,
        'title' => $request->title,
        'description' => $request->description,
        'prep_time' => $request->prep_time,
        'image' => $imagePath,
        'video_url' => $request->video_url,
      ]);

      // =====================
      // SYNC INGREDIENTS
      // =====================
      $syncData = [];

      foreach ($request->ingredients as $ingredient) {

        if (empty($ingredient['food_id'])) continue;

        $syncData[$ingredient['food_id']] = [
          'quantity' => $ingredient['quantity'],
        ];
      }

      $meal->foods()->sync($syncData);

      // =====================
      // REPLACE STEPS
      // =====================
      $meal->steps()->delete();

      foreach ($request->steps as $step) {

        MealStep::create([
          'meal_id' => $meal->id,
          'step_number' => $step['step_number'],
          'instruction' => $step['instruction'],
        ]);
      }

      DB::commit();

      $meals = Meal::with(['category', 'goal'])
        ->latest()
        ->paginate(30);

      return response()->json([
        'success' => true,
        'message' => 'Meal berhasil diperbarui.',
        'html' => view(
          'admin.meals.items.partials._table',
          compact('meals')
        )->render()
      ]);
    } catch (\Exception $e) {

      DB::rollBack();

      return response()->json([
        'success' => false,
        'message' => 'Gagal memperbarui meal.'
      ], 500);
    }
  }

  public function foodSuggest(Request $request)
  {
    $q = trim($request->q);

    if (!$q) {
      return response()->json([]);
    }

    $foods = Food::where('name', 'like', "%{$q}%")
      ->orderBy('name')
      ->limit(10)
      ->get(['id', 'name']);

    return response()->json($foods);
  }

  public function suggest(Request $request)
  {
    $query = Meal::query();

    if ($request->filled('category')) {
      $query->whereHas('category', function ($q) use ($request) {
        $q->where('slug', $request->category);
      });
    }

    if ($request->filled('goal')) {
      $query->whereHas('goal', function ($q) use ($request) {
        $q->where('slug', $request->goal);
      });
    }

    if ($request->filled('q')) {
      $query->where('title', 'like', '%' . $request->q . '%');
    }

    return response()->json(
      $query->limit(20)->pluck('title')
    );
  }

  public function destroy(\App\Models\Meal $meal)
  {
    DB::beginTransaction();

    try {

      // =====================
      // HAPUS IMAGE + THUMB
      // =====================
      if ($meal->image) {

        $imagePath = storage_path('app/public/' . $meal->image);

        if (file_exists($imagePath)) {
          unlink($imagePath);
        }

        $thumbPath = storage_path('app/public/meals/thumb/' .
          pathinfo($meal->image, PATHINFO_FILENAME) . '.webp');

        if (file_exists($thumbPath)) {
          unlink($thumbPath);
        }
      }

      // =====================
      // HAPUS RELASI
      // =====================
      $meal->foods()->detach();
      $meal->steps()->delete();

      // =====================
      // HAPUS MEAL
      // =====================
      $meal->delete();

      DB::commit();

      $meals = \App\Models\Meal::with(['category', 'goal'])
        ->latest()
        ->get();

      return response()->json([
        'success' => true,
        'message' => 'Meal berhasil dihapus.',
        'html' => view(
          'admin.meals.items.partials._table',
          compact('meals')
        )->render()
      ]);
    } catch (\Exception $e) {

      DB::rollBack();

      return response()->json([
        'success' => false,
        'message' => 'Gagal menghapus meal.'
      ], 500);
    }
  }
}
