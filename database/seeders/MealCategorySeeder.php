<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealCategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('meal_categories')->insert([
      [
        'id' => 1,
        'name' => 'Sayur',
        'slug' => 'sayur',
        'description' => 'Masakan sayur.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 2,
        'name' => 'Dessert',
        'slug' => 'dessert',
        'description' => 'Dessert meals.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}