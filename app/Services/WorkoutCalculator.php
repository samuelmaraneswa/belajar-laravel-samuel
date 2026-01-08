<?php

namespace App\Services;

use App\Models\Workout;

class WorkoutCalculator
{
  public static function calculate(array $data, Workout $workout): array
  {
    $genderFactor = $data['gender'] === 'female' ? 0.8 : 1;
    $heightFactor = $data['height'] >= 175 ? 1.05 : ($data['height'] < 160 ? 0.95 : 1);
    $ageFactor    = $data['age'] >= 45 ? 0.85 : ($data['age'] >= 35 ? 0.92 : 1);

    $baseWeight = $data['weight'] * $genderFactor * $heightFactor * $ageFactor;

    if ($workout->type === 'bodyweight') {
      return [
        'beginner' => ['sets' => 3, 'reps' => '4–6'],
        'intermediate' => ['sets' => 4, 'reps' => '6–8'],
        'advanced' => ['sets' => 4, 'reps' => '8–12'],
      ];
    }

    return [
      'beginner' => [
        'sets' => 4,
        'reps' => '8–12',
        'weight' => round($baseWeight * 0.4),
      ],
      'intermediate' => [
        'sets' => 4,
        'reps' => '8–12',
        'weight' => round($baseWeight * 0.55),
      ],
      'advanced' => [
        'sets' => 5,
        'reps' => '15++',
        'weight' => round($baseWeight * 0.7),
      ],
    ];
  }
}
