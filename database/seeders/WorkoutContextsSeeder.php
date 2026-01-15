<?php

namespace Database\Seeders;

use App\Models\WorkoutContext;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WorkoutContextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
  {
    $contexts = [
      'Gym',
      'Home',
      'Calisthenics',
    ];

    foreach ($contexts as $name) {
      WorkoutContext::firstOrCreate(
        ['slug' => Str::slug($name)],
        ['name' => $name]
      );
    }
  }
}
