<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Food;
use App\Models\FoodNutrition;

class FoodSeeder extends Seeder
{
  public function run(): void
  {
    // =========================
    // FOODS
    // =========================
    Food::insert([
      [
        'id' => 1,
        'name' => 'Telur Ayam',
        'slug' => 'telur-ayam',
        'description' => '1 butir telur ayam mentah.',
        'image' => 'foods/219db195-9c6d-4670-8b5b-482fbeaaeae4.webp',
        'serving_base_value' => 1.00,
        'serving_unit' => 'pcs',
        'density' => null,
        'is_active' => true,
        'created_at' => '2026-02-20 08:11:55',
        'updated_at' => '2026-02-20 08:33:30',
      ],
      [
        'id' => 2,
        'name' => 'Dada Ayam Rebus Tanpa Kulit',
        'slug' => 'dada-ayam-rebus-tanpa-kulit',
        'description' => '100gr dada ayam rebus tanpa kulit',
        'image' => 'foods/0455d84a-c7d7-4d42-b93a-1b92fcea0e55.webp',
        'serving_base_value' => 100.00,
        'serving_unit' => 'g',
        'density' => null,
        'is_active' => true,
        'created_at' => '2026-02-20 08:26:24',
        'updated_at' => '2026-02-20 08:26:24',
      ],
    ]);

    // =========================
    // FOOD NUTRITIONS
    // =========================
    FoodNutrition::insert([
      [
        'id' => 1,
        'food_id' => 1,

        'calories_kcal' => 72.00,
        'protein_g' => 6.30,
        'fat_g' => 5.00,
        'carbs_g' => 0.40,
        'fiber_g' => 0.00,
        'sugar_g' => 0.20,
        'water_g' => 37.00,
        'alcohol_g' => 0.00,

        'saturated_fat_g' => 1.60,
        'monounsaturated_fat_g' => 2.00,
        'polyunsaturated_fat_g' => 0.70,
        'trans_fat_g' => 0.00,
        'cholesterol_mg' => 186.00,

        'sodium_mg' => 71.00,
        'potassium_mg' => 69.00,
        'calcium_mg' => 28.00,
        'iron_mg' => 0.90,
        'magnesium_mg' => 6.00,
        'zinc_mg' => 0.60,

        'vitamin_a_mcg' => 80.00,
        'vitamin_b1_mg' => 0.02,
        'vitamin_b2_mg' => 0.25,
        'vitamin_b3_mg' => 0.04,
        'vitamin_b6_mg' => 0.10,
        'vitamin_b12_mcg' => 0.60,
        'vitamin_c_mg' => 0.00,
        'vitamin_d_mcg' => 1.10,
        'vitamin_e_mg' => 0.50,
        'vitamin_k_mcg' => 0.30,
        'folate_mcg' => 24.00,

        'created_at' => '2026-02-20 08:11:55',
        'updated_at' => '2026-02-20 08:33:30',
      ],
      [
        'id' => 2,
        'food_id' => 2,

        'calories_kcal' => 165.00,
        'protein_g' => 31.00,
        'fat_g' => 3.60,
        'carbs_g' => 0.00,
        'fiber_g' => 0.00,
        'sugar_g' => 0.00,
        'water_g' => 65.00,
        'alcohol_g' => 0.00,

        'saturated_fat_g' => 1.00,
        'monounsaturated_fat_g' => 1.20,
        'polyunsaturated_fat_g' => 0.80,
        'trans_fat_g' => 0.00,
        'cholesterol_mg' => 85.00,

        'sodium_mg' => 74.00,
        'potassium_mg' => 256.00,
        'calcium_mg' => 15.00,
        'iron_mg' => 1.00,
        'magnesium_mg' => 29.00,
        'zinc_mg' => 1.00,

        'vitamin_a_mcg' => 13.00,
        'vitamin_b1_mg' => 0.07,
        'vitamin_b2_mg' => 0.10,
        'vitamin_b3_mg' => 13.70,
        'vitamin_b6_mg' => 0.60,
        'vitamin_b12_mcg' => 0.30,
        'vitamin_c_mg' => 0.00,
        'vitamin_d_mcg' => 0.10,
        'vitamin_e_mg' => 0.30,
        'vitamin_k_mcg' => 0.30,
        'folate_mcg' => 4.00,

        'created_at' => '2026-02-20 08:26:25',
        'updated_at' => '2026-02-20 08:26:25',
      ],
    ]);
  }
}
