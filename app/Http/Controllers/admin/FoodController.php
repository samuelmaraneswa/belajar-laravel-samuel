<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FoodController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->query('search');

    $foods = Food::query()
      ->when(
        $search,
        fn($q) =>
        $q->where('name', 'like', "%{$search}%")
      )
      ->latest()
      ->paginate(20);

    if ($request->ajax()) {
      return response()->json([
        'html' => view('admin.foods.partials._table', compact('foods'))->render(),
        'pagination' => [
          'page' => $foods->currentPage(),
          'last' => $foods->lastPage(), // ← HARUS last
        ]
      ]);
    }

    return view('admin.foods.index', compact('foods', 'search'));
  }

  public function create()
  {
    return view('admin.foods.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([

      // foods table
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
      'image' => 'nullable|image|max:10048',
      'is_active' => 'nullable|boolean',

      'serving_base_value' => 'required|numeric|min:0.01',
      'serving_unit' => 'required|string|in:g,ml,pcs,tbsp,tsp',
      'density' => 'nullable|numeric|min:0',

      'calories_kcal' => 'nullable|numeric|min:0',
      'protein_g' => 'nullable|numeric|min:0',
      'fat_g' => 'nullable|numeric|min:0',
      'carbs_g' => 'nullable|numeric|min:0',
      'fiber_g' => 'nullable|numeric|min:0',
      'sugar_g' => 'nullable|numeric|min:0',
      'water_g' => 'nullable|numeric|min:0',
      'alcohol_g' => 'nullable|numeric|min:0',

      'saturated_fat_g' => 'nullable|numeric|min:0',
      'monounsaturated_fat_g' => 'nullable|numeric|min:0',
      'polyunsaturated_fat_g' => 'nullable|numeric|min:0',
      'trans_fat_g' => 'nullable|numeric|min:0',
      'cholesterol_mg' => 'nullable|numeric|min:0',

      'sodium_mg' => 'nullable|numeric|min:0',
      'potassium_mg' => 'nullable|numeric|min:0',
      'calcium_mg' => 'nullable|numeric|min:0',
      'iron_mg' => 'nullable|numeric|min:0',
      'magnesium_mg' => 'nullable|numeric|min:0',
      'zinc_mg' => 'nullable|numeric|min:0',

      'vitamin_a_mcg' => 'nullable|numeric|min:0',
      'vitamin_b1_mg' => 'nullable|numeric|min:0',
      'vitamin_b2_mg' => 'nullable|numeric|min:0',
      'vitamin_b3_mg' => 'nullable|numeric|min:0',
      'vitamin_b6_mg' => 'nullable|numeric|min:0',
      'vitamin_b12_mcg' => 'nullable|numeric|min:0',
      'vitamin_c_mg' => 'nullable|numeric|min:0',
      'vitamin_d_mcg' => 'nullable|numeric|min:0',
      'vitamin_e_mg' => 'nullable|numeric|min:0',
      'vitamin_k_mcg' => 'nullable|numeric|min:0',
      'folate_mcg' => 'nullable|numeric|min:0',
    ]);

    DB::transaction(function () use ($validated, $request) {

      $imagePath = null;

      if ($request->hasFile('image')) {

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('image'));

        $image->scale(width: 800);

        $filename = Str::uuid() . '.webp';
        $path = 'foods/' . $filename;

        $image
          ->toWebp(90)
          ->save(storage_path('app/public/' . $path));

        $imagePath = $path;
      }

      /*
        |--------------------------------------------------------------------------
        | Create Food
        |--------------------------------------------------------------------------
        */
      $food = Food::create([
        'name' => $validated['name'],
        'slug' => Str::slug($validated['name']),
        'description' => $validated['description'] ?? null,
        'image' => $imagePath,
        'is_active' => $request->boolean('is_active'),

        // NEW FIELDS
        'serving_base_value' => $validated['serving_base_value'],
        'serving_unit' => $validated['serving_unit'],
        'density' => $validated['density'] ?? null,
      ]);

      /*
        |--------------------------------------------------------------------------
        | Create Nutrition
        |--------------------------------------------------------------------------
        */
      $food->nutrition()->create(
        collect($validated)
          ->except([
            'name',
            'description',
            'image',
            'is_active',
            'serving_base_value',
            'serving_unit',
            'density'
          ])
          ->toArray()
      );
    });

    return redirect()
      ->route('admin.foods.index')
      ->with('success', 'Food created successfully.');
  }

  public function show(Food $food)
  {
    $food->load('nutrition');

    return view('admin.foods._show', compact('food'));
  }

  public function edit(Food $food)
  {
    $food->load('nutrition');

    return view('admin.foods.edit', compact('food'));
  }

  public function update(Request $request, Food $food)
  {
    $validated = $request->validate([

      // foods
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
      'image' => 'nullable|image|max:10048',
      'is_active' => 'nullable|boolean',

      'serving_base_value' => 'required|numeric|min:0.01',
      'serving_unit' => 'required|string|in:g,ml,pcs,tbsp,tsp',
      'density' => 'nullable|numeric|min:0',

      'calories_kcal' => 'nullable|numeric|min:0',
      'protein_g' => 'nullable|numeric|min:0',
      'fat_g' => 'nullable|numeric|min:0',
      'carbs_g' => 'nullable|numeric|min:0',
      'fiber_g' => 'nullable|numeric|min:0',
      'sugar_g' => 'nullable|numeric|min:0',
      'water_g' => 'nullable|numeric|min:0',
      'alcohol_g' => 'nullable|numeric|min:0',

      'saturated_fat_g' => 'nullable|numeric|min:0',
      'monounsaturated_fat_g' => 'nullable|numeric|min:0',
      'polyunsaturated_fat_g' => 'nullable|numeric|min:0',
      'trans_fat_g' => 'nullable|numeric|min:0',
      'cholesterol_mg' => 'nullable|numeric|min:0',

      'sodium_mg' => 'nullable|numeric|min:0',
      'potassium_mg' => 'nullable|numeric|min:0',
      'calcium_mg' => 'nullable|numeric|min:0',
      'iron_mg' => 'nullable|numeric|min:0',
      'magnesium_mg' => 'nullable|numeric|min:0',
      'zinc_mg' => 'nullable|numeric|min:0',

      'vitamin_a_mcg' => 'nullable|numeric|min:0',
      'vitamin_b1_mg' => 'nullable|numeric|min:0',
      'vitamin_b2_mg' => 'nullable|numeric|min:0',
      'vitamin_b3_mg' => 'nullable|numeric|min:0',
      'vitamin_b6_mg' => 'nullable|numeric|min:0',
      'vitamin_b12_mcg' => 'nullable|numeric|min:0',
      'vitamin_c_mg' => 'nullable|numeric|min:0',
      'vitamin_d_mcg' => 'nullable|numeric|min:0',
      'vitamin_e_mg' => 'nullable|numeric|min:0',
      'vitamin_k_mcg' => 'nullable|numeric|min:0',
      'folate_mcg' => 'nullable|numeric|min:0',
    ]);

    DB::transaction(function () use ($validated, $request, $food) {

      $imagePath = $food->image;

      /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */
      if ($request->hasFile('image')) {

        if ($food->image && Storage::disk('public')->exists($food->image)) {
          Storage::disk('public')->delete($food->image);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('image'));

        $image->scale(width: 800);

        $filename = Str::uuid() . '.webp';
        $path = 'foods/' . $filename;

        $image
          ->toWebp(90)
          ->save(storage_path('app/public/' . $path));

        $imagePath = $path;
      }

      /*
        |--------------------------------------------------------------------------
        | Update Food
        |--------------------------------------------------------------------------
        */
      $food->update([
        'name' => $validated['name'],
        'slug' => Str::slug($validated['name']),
        'description' => $validated['description'] ?? null,
        'image' => $imagePath,
        'is_active' => $request->boolean('is_active'),

        // NEW FIELDS
        'serving_base_value' => $validated['serving_base_value'],
        'serving_unit' => $validated['serving_unit'],
        'density' => $validated['density'] ?? null,
      ]);

      /*
        |--------------------------------------------------------------------------
        | Update Nutrition
        |--------------------------------------------------------------------------
        */
      $food->nutrition()->update(
        collect($validated)
          ->except([
            'name',
            'description',
            'image',
            'is_active',
            'serving_base_value',
            'serving_unit',
            'density'
          ])
          ->toArray()
      );
    });

    return redirect()
      ->route('admin.foods.index')
      ->with('success', 'Food updated successfully.');
  }

  public function destroy(Food $food)
  {
    $food->update([
      'is_active' => false
    ]);

    return redirect()
      ->route('admin.foods.index')
      ->with('success', 'Food berhasil dinonaktifkan.');
  }

  public function suggest(Request $request)
  {
    $q = $request->query('q');

    return Food::where('name', 'like', "%{$q}%")
      ->limit(20)
      ->pluck('name');
  }
}
