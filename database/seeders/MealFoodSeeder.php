<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealFoodSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('meal_food')->insert([
      ['meal_id' => 1, 'food_id' => 6, 'quantity' => 100.00, 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'food_id' => 7, 'quantity' => 0.50, 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'food_id' => 11, 'quantity' => 1.00, 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'food_id' => 3, 'quantity' => 0.50, 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'food_id' => 4, 'quantity' => 0.50, 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'food_id' => 5, 'quantity' => 0.50, 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 2, 'food_id' => 1, 'quantity' => 3.00, 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 2, 'food_id' => 3, 'quantity' => 0.50, 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
