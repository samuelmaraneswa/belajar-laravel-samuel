<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealGoalSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('meal_goals')->insert([
      ['id' => 1, 'name' => 'Bulking', 'slug' => 'bulking', 'description' => 'Bulking meals', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 2, 'name' => 'Cutting', 'slug' => 'cutting', 'description' => 'Cutting meals', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 3, 'name' => 'Maintenance', 'slug' => 'maintenance', 'description' => 'Maintenance meals', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}