<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
  {
    $equipments = [
      'Bodyweight',
      'Pull Up Bar',
      'Dumbbell',
      'Barbell',
      'Bench',
      'Kettlebell',
      'Resistance Band',
      'Cable Machine',
      'Smith Machine',
      'Medicine Ball',
    ];

    foreach ($equipments as $name) {
      Equipment::firstOrCreate(
        ['slug' => Str::slug($name)],
        ['name' => $name]
      );
    }
  }
}
