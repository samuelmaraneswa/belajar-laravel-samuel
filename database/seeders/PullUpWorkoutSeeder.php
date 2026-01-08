<?php

namespace Database\Seeders;

use App\Models\Workout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PullUpWorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Workout::updateOrCreate(
      ['title' => 'Pull Up'],
      [
        'workout_category_id' => 2,
        'description' => 'Bodyweight back exercise',
        'is_custom' => true,
        'custom_rules' => [
          'beginner' => ['sets' => 1, 'reps' => 8],
          'intermediate' => ['sets' => 1, 'reps' => 15],
          'advanced' => ['sets' => 1, 'reps' => 25],
        ]
      ]
    );
    }
}
