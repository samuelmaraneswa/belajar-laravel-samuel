<?php

namespace Database\Seeders;

use App\Models\Muscle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $muscles = [
        ['name' => 'Chest', 'slug' => 'chest'],
        ['name' => 'Back', 'slug' => 'back'],
        ['name' => 'Biceps', 'slug' => 'biceps'],
        ['name' => 'Triceps', 'slug' => 'triceps'],
        ['name' => 'Shoulders', 'slug' => 'shoulders'],
        ['name' => 'Core', 'slug' => 'core'],
        ['name' => 'Quads', 'slug' => 'quads'],
        ['name' => 'Hamstring', 'slug' => 'hamstring'],
        ['name' => 'Obliques', 'slug' => 'obliques'],
        ['name' => 'Trapezius', 'slug' => 'trapezius'],
        ['name' => 'Forearms', 'slug' => 'forearms'],
        ['name' => 'Calves', 'slug' => 'calves'],
        ['name' => 'Abductors', 'slug' => 'abductors'],
        ['name' => 'Adductors', 'slug' => 'adductors'],
        ['name' => 'Necks', 'slug' => 'necks'],
        ['name' => 'Glutes', 'slug' => 'glutes'],
        ['name' => 'Lower Back', 'slug' => 'lower-back'],
      ];

      foreach ($muscles as $muscle) {
        Muscle::firstOrCreate(['slug' => $muscle['slug']], $muscle);
      }
    }
}
