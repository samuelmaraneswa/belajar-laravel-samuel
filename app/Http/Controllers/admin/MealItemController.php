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

  public function store(Request $request)
  {
    $request->validate([
      'category_id' => 'required|exists:meal_categories,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'prep_time' => 'nullable|integer',
      'image' => 'nullable|image|max:2048',
      'ingredients' => 'required|array|min:1',
      'steps' => 'required|array|min:1',
    ]);

    DB::beginTransaction();

    try {

      $imagePath = null;

      // =====================
      // UPLOAD IMAGE + THUMB
      // =====================
      $imagePath = null;
      $thumbPath = null;

      if ($request->hasFile('image')) {

        $imageFile = $request->file('image');

        // simpan original
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

        $thumb = clone $image;

        $thumb
          ->toWebp(70)
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
      'steps' => 'required|array|min:1',
    ]);

    DB::beginTransaction();

    try {

      $imagePath = $meal->image;
      $thumbPath = null;

      // =====================
      // REPLACE IMAGE
      // =====================
      if ($request->hasFile('image')) {

        // Hapus gambar lama
        if ($meal->image && file_exists(storage_path('app/public/' . $meal->image))) {
          unlink(storage_path('app/public/' . $meal->image));
        }

        $oldThumb = 'meals/thumb/' . pathinfo($meal->image, PATHINFO_FILENAME) . '.webp';
        if (file_exists(storage_path('app/public/' . $oldThumb))) {
          unlink(storage_path('app/public/' . $oldThumb));
        }

        // Upload baru
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

        $image
          ->toWebp(70)
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
}
