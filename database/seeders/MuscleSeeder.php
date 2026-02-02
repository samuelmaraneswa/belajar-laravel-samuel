<?php

namespace Database\Seeders;

use App\Models\Muscle;
use Illuminate\Database\Seeder;

class MuscleSeeder extends Seeder
{
  public function run(): void
  {
    $muscles = [
      [1, 'Chest', 'chest'],
      [2, 'Back', 'back'],
      [3, 'Biceps', 'biceps'],
      [4, 'Triceps', 'triceps'],
      [5, 'Shoulders', 'shoulders'],
      [6, 'Core', 'core'],
      [7, 'Quads', 'quads'],
      [8, 'Hamstring', 'hamstring'],
      [9, 'Obliques', 'obliques'],
      [10, 'Trapezius', 'trapezius'],
      [11, 'Forearms', 'forearms'],
      [12, 'Calves', 'calves'],
      [13, 'Abductors', 'abductors'],
      [14, 'Adductors', 'adductors'],
      [15, 'Necks', 'necks'],
      [16, 'Glutes', 'glutes'],
      [17, 'Lower Back', 'lower-back'],
    ];

    foreach ($muscles as [$id, $name, $slug]) {
      Muscle::updateOrCreate(
        ['id' => $id],
        [
          'name' => $name,
          'slug' => $slug,
          'created_at' => '2026-01-14 09:33:15',
          'updated_at' => '2026-01-14 09:33:15',
        ]
      );
    }
  }
}
