<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutContextsSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('workout_contexts')->insert([
      [
        'id' => 1,
        'name' => 'Gym Workout',
        'slug' => 'gym-workout',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 2,
        'name' => 'Home Workout',
        'slug' => 'home-workout',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 3,
        'name' => 'Calisthenics',
        'slug' => 'calisthenics',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 4,
        'name' => 'Gymnastic',
        'slug' => 'gymnastic',
        'created_at' => null,
        'updated_at' => null,
      ],
      [
        'id' => 5,
        'name' => 'Cardiovaskular',
        'slug' => 'cardiovaskular',
        'created_at' => null,
        'updated_at' => null,
      ],
      [
        'id' => 6,
        'name' => 'Mobility',
        'slug' => 'mobility',
        'created_at' => null,
        'updated_at' => null,
      ],
    ]);
  }
}
