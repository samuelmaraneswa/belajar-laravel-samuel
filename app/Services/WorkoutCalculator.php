<?php

namespace App\Services;

use App\Models\Workout;

class WorkoutCalculator
{
  public static function calculate(array $data, Workout $workout, ?string $context = null): array
  {
    $genderFactor = $data['gender'] === 'female' ? 0.8 : 1;
    $heightFactor = $data['height'] >= 175 ? 1.05 : ($data['height'] < 160 ? 0.95 : 1);
    $ageFactor    = $data['age'] >= 45 ? 0.85 : ($data['age'] >= 35 ? 0.92 : 1);

    $baseWeight = $data['weight'] * $genderFactor * $heightFactor * $ageFactor;

    /**
     * ==================
     * RESISTANCE BAND
     * ==================
     */
    if ($workout->type === 'resistance-band') {

      $bandLevels = [
        'beginner' => 'Light Band',
        'intermediate' => 'Medium Band',
        'advanced' => 'Heavy Band',
      ];

      return [
        'beginner' => [
          'sets' => 3,
          'reps' => '12–15',
          'band' => $bandLevels['beginner'],
        ],
        'intermediate' => [
          'sets' => 4,
          'reps' => '12–15',
          'band' => $bandLevels['intermediate'],
        ],
        'advanced' => [
          'sets' => 4,
          'reps' => '15–20',
          'band' => $bandLevels['advanced'],
        ],
      ];
    }

    /**
     * =========================
     * ASSISTED (BEGINNER ONLY)
     * =========================
     */
    if ($workout->type === 'assisted') {
      // assistance = berapa kg bantuan
      // makin besar bodyweight → makin besar bantuan
      $assistance = round($baseWeight * 0.4); // 40% bantuan awal (aman untuk beginner)

      return [
        'assisted' => [
          'sets' => 3,
          'reps' => '6–8',
          'assistance' => $assistance, // kg bantuan
        ],
      ];
    }

    /**
     * ===========
     * BODYWEIGHT
     * ===========
     */
    if ($workout->type === 'bodyweight') {
      return [
        'beginner' => ['sets' => 3, 'reps' => '6–8'],
        'intermediate' => ['sets' => 4, 'reps' => '8–12'],
        'advanced' => ['sets' => 4, 'reps' => '12–15'],
      ];
    }

    /**
     * ==========
     * WEIGHTED
     * ==========
     */
    $reps = $workout->movement === 'isolation'
      ? ['beginner' => '12–15', 'intermediate' => '12–15', 'advanced' => '15+']
      : ['beginner' => '8–12', 'intermediate' => '8–12', 'advanced' => '6–10'];

    $levelFactor = [
      'beginner' => 0.4,
      'intermediate' => 0.55,
      'advanced' => 0.7,
    ];

    $difficulty = $workout->difficulty_factor ?? 1;

    return [
      'beginner' => [
        'sets' => 4,
        'reps' => $reps['beginner'],
        'weight' => round($baseWeight * $difficulty * $levelFactor['beginner']),
      ],
      'intermediate' => [
        'sets' => 4,
        'reps' => $reps['intermediate'],
        'weight' => round($baseWeight * $difficulty * $levelFactor['intermediate']),
      ],
      'advanced' => [
        'sets' => 5,
        'reps' => $reps['advanced'],
        'weight' => round($baseWeight * $difficulty * $levelFactor['advanced']),
      ],
    ];
  }
}
