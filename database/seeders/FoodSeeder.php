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
        [
          'id' => 1,
          'name' => 'Dada Ayam Rebus Tanpa Kulit',
          'slug' => 'dada-ayam-rebus-tanpa-kulit',
          'description' => 'Dada ayam tanpa kulit yang direbus, sumber protein tinggi dan rendah lemak.',
          'image' => 'foods/a9a3f19f-4678-4c5b-a386-7494411a060f.webp',
          'is_active' => true,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'id' => 2,
          'name' => 'Ikan Nila Rebus',
          'slug' => 'ikan-nila-rebus',
          'description' => 'Ikan nila rebus sumber protein tinggi dan rendah lemak.',
          'image' => 'foods/052122a9-e3c0-4106-b6f5-cc0c35be25a0.webp',
          'is_active' => true,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'id' => 3,
          'name' => 'Ikan Gembung Rebus',
          'slug' => 'ikan-gembung-rebus',
          'description' => 'Ikan gembung rebus kaya protein dan omega-3.',
          'image' => 'foods/70e63152-d761-4dba-9719-7e914ac6ee36.webp',
          'is_active' => true,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'id' => 4,
          'name' => 'Ikan Tongkol Rebus',
          'slug' => 'ikan-tongkol-rebus',
          'description' => 'Ikan tongkol rebus sumber protein dan mineral.',
          'image' => 'foods/3b465dcf-a6a6-41d5-b87a-d7d3b194104b.webp',
          'is_active' => true,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'id' => 5,
          'name' => 'Daging Sapi Tanpa Lemak Rebus',
          'slug' => 'daging-sapi-tanpa-lemak-rebus',
          'description' => 'Daging sapi tanpa lemak yang direbus, tinggi protein dan zat besi.',
          'image' => 'foods/0e6799d8-9429-43c7-9207-562cdd49735d.webp',
          'is_active' => true,
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]
    ]);

    // =========================
    // FOOD NUTRITIONS
    // =========================
    FoodNutrition::insert([
      [
        'food_id' => 1,

        'serving_base_gram' => 100.00,

        // Macronutrients
        'calories_kcal' => 165.00,
        'protein_g' => 31.00,
        'fat_g' => 3.60,
        'carbs_g' => 0.00,
        'fiber_g' => 0.00,
        'sugar_g' => 0.00,
        'water_g' => 65.00,
        'alcohol_g' => 0.00,

        // Fat Detail
        'saturated_fat_g' => 1.00,
        'monounsaturated_fat_g' => 1.20,
        'polyunsaturated_fat_g' => 0.80,
        'trans_fat_g' => 0.00,
        'cholesterol_mg' => 85.00,

        // Minerals
        'sodium_mg' => 74.00,
        'potassium_mg' => 256.00,
        'calcium_mg' => 15.00,
        'iron_mg' => 1.00,
        'magnesium_mg' => 29.00,
        'zinc_mg' => 1.00,

        // Vitamins
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

        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'food_id' => 2,
        'serving_base_gram' => 100.00,

        'calories_kcal' => 128.00,
        'protein_g' => 26.00,
        'fat_g' => 2.70,
        'carbs_g' => 0.00,
        'fiber_g' => 0.00,
        'sugar_g' => 0.00,
        'water_g' => 70.00,
        'alcohol_g' => 0.00,

        'saturated_fat_g' => 0.90,
        'monounsaturated_fat_g' => 1.00,
        'polyunsaturated_fat_g' => 0.50,
        'trans_fat_g' => 0.00,
        'cholesterol_mg' => 57.00,

        'sodium_mg' => 52.00,
        'potassium_mg' => 302.00,
        'calcium_mg' => 10.00,
        'iron_mg' => 0.60,
        'magnesium_mg' => 27.00,
        'zinc_mg' => 0.40,

        'vitamin_a_mcg' => 20.00,
        'vitamin_b1_mg' => 0.04,
        'vitamin_b2_mg' => 0.06,
        'vitamin_b3_mg' => 4.80,
        'vitamin_b6_mg' => 0.20,
        'vitamin_b12_mcg' => 1.60,
        'vitamin_c_mg' => 0.00,
        'vitamin_d_mcg' => 2.00,
        'vitamin_e_mg' => 0.40,
        'vitamin_k_mcg' => 0.10,
        'folate_mcg' => 24.00,

        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'food_id' => 3,
        'serving_base_gram' => 100.00,

        'calories_kcal' => 167.00,
        'protein_g' => 20.00,
        'fat_g' => 9.40,
        'carbs_g' => 0.00,
        'fiber_g' => 0.00,
        'sugar_g' => 0.00,
        'water_g' => 68.00,
        'alcohol_g' => 0.00,

        'saturated_fat_g' => 2.60,
        'monounsaturated_fat_g' => 3.50,
        'polyunsaturated_fat_g' => 2.60,
        'trans_fat_g' => 0.00,
        'cholesterol_mg' => 70.00,

        'sodium_mg' => 90.00,
        'potassium_mg' => 314.00,
        'calcium_mg' => 20.00,
        'iron_mg' => 1.60,
        'magnesium_mg' => 30.00,
        'zinc_mg' => 0.60,

        'vitamin_a_mcg' => 40.00,
        'vitamin_b1_mg' => 0.10,
        'vitamin_b2_mg' => 0.20,
        'vitamin_b3_mg' => 8.00,
        'vitamin_b6_mg' => 0.40,
        'vitamin_b12_mcg' => 9.00,
        'vitamin_c_mg' => 0.00,
        'vitamin_d_mcg' => 4.00,
        'vitamin_e_mg' => 1.50,
        'vitamin_k_mcg' => 0.10,
        'folate_mcg' => 10.00,

        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'food_id' => 4,
        'serving_base_gram' => 100.00,

        'calories_kcal' => 132.00,
        'protein_g' => 24.00,
        'fat_g' => 1.00,
        'carbs_g' => 0.00,
        'fiber_g' => 0.00,
        'sugar_g' => 0.00,
        'water_g' => 72.00,
        'alcohol_g' => 0.00,

        'saturated_fat_g' => 0.30,
        'monounsaturated_fat_g' => 0.20,
        'polyunsaturated_fat_g' => 0.30,
        'trans_fat_g' => 0.00,
        'cholesterol_mg' => 50.00,

        'sodium_mg' => 45.00,
        'potassium_mg' => 350.00,
        'calcium_mg' => 12.00,
        'iron_mg' => 1.00,
        'magnesium_mg' => 35.00,
        'zinc_mg' => 0.70,

        'vitamin_a_mcg' => 25.00,
        'vitamin_b1_mg' => 0.05,
        'vitamin_b2_mg' => 0.07,
        'vitamin_b3_mg' => 10.00,
        'vitamin_b6_mg' => 0.50,
        'vitamin_b12_mcg' => 2.00,
        'vitamin_c_mg' => 0.00,
        'vitamin_d_mcg' => 2.50,
        'vitamin_e_mg' => 0.50,
        'vitamin_k_mcg' => 0.10,
        'folate_mcg' => 5.00,

        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'food_id' => 5,
        'serving_base_gram' => 100.00,

        'calories_kcal' => 217.00,
        'protein_g' => 26.00,
        'fat_g' => 12.00,
        'carbs_g' => 0.00,
        'fiber_g' => 0.00,
        'sugar_g' => 0.00,
        'water_g' => 61.00,
        'alcohol_g' => 0.00,

        'saturated_fat_g' => 4.80,
        'monounsaturated_fat_g' => 5.00,
        'polyunsaturated_fat_g' => 0.50,
        'trans_fat_g' => 0.00,
        'cholesterol_mg' => 90.00,

        'sodium_mg' => 72.00,
        'potassium_mg' => 318.00,
        'calcium_mg' => 18.00,
        'iron_mg' => 2.60,
        'magnesium_mg' => 21.00,
        'zinc_mg' => 4.80,

        'vitamin_a_mcg' => 0.00,
        'vitamin_b1_mg' => 0.05,
        'vitamin_b2_mg' => 0.20,
        'vitamin_b3_mg' => 6.00,
        'vitamin_b6_mg' => 0.40,
        'vitamin_b12_mcg' => 2.50,
        'vitamin_c_mg' => 0.00,
        'vitamin_d_mcg' => 0.10,
        'vitamin_e_mg' => 0.30,
        'vitamin_k_mcg' => 1.30,
        'folate_mcg' => 6.00,

        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
