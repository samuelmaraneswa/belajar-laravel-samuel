<?php

namespace App\Services;

class ProgramTemplates
{
  public static function muscleGainBeginner(): array
  {
    return [

      // ===== WEEK 1 =====
      1 => [
        'title' => 'Chest & Triceps',
        'workouts' => [
          'barbell-bench-press',
          'barbell-incline-bench-press',
          'chest-dips',
          'pec-deck-fly',
          'cable-straight-bar-tricep-pushdown',
          'cable-rope-overhead-triceps-extension',
        ],
      ],

      2 => [
        'title' => 'Back & Biceps',
        'workouts' => [
          'lat-pulldown',
          'cable-seated-row',
          'neutral-lat-pulldown',
          'supinated-grip-lat-pulldown',
          'ez-bar-curl',
          'dumbbell-bicep-curl',
          'straight-arm-lat-pushdown',
        ],
      ],

      3 => [
        'title' => 'Legs',
        'workouts' => [
          'back-squat',
          'leg-press',
          'barbell-deadlift',
          'leg-extension',
          'smith-machine-calf-raise',
        ],
      ],

      4 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      5 => [
        'title' => 'Shoulders',
        'workouts' => [
          'dumbbell-shoulder-press',
          'dumbbell-lateral-raise',
          'dumbbell-rear-delt-row',
          'machine-shoulder-press',
          'dumbbell-front-raise',
          'barbell-shrug',
        ],
      ],

      6 => [
        'title' => 'Arms & Core',
        'workouts' => [
          'dumbbell-wrist-curl',
          'dumbbell-reverse-wrist-curl',
          'barbell-skull-crusher',
          'dumbbell-hammer-curl',
          'cable-crunch',
          'captains-chair-leg-raises',
        ],
      ],

      7 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      // ===== WEEK 2 =====
      8 => [
        'title' => 'Chest & Triceps',
        'workouts' => [
          'dumbbell-bench-press',
          'dumbbell-incline-bench-press',
          'smith-machine-decline-bench-press',
          'dumbbell-fly',
          'rope-triceps-pushdown',
          'cable-rope-overhead-triceps-extension',
        ],
      ],

      9 => [
        'title' => 'Back & Biceps',
        'workouts' => [
          'assisted-pull-up',
          'dumbbell-row',
          'barbell-bent-over-row',
          'yates-row',
          'dumbbell-bicep-curl',
          'lever-preacher-curl',
        ],
      ],

      10 => [
        'title' => 'Shoulders',
        'workouts' => [
          'barbell-shoulder-press',
          'lateral-raise-machine',
          'shoulder-press-machine',
          'dumbbell-rear-delt-fly',
          'dumbbell-front-raise',
          'cable-upright-row',
        ],
      ],

      11 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      12 => [
        'title' => 'Legs',
        'workouts' => [
          'hack-squat',
          'seated-leg-curl',
          'barbell-romanian-deadlift',
          'hip-adduction',
          'hip-abduction',
          'smith-machine-calf-raise',
        ],
      ],

      13 => [
        'title' => 'Arms & Core',
        'workouts' => [
          'reverse-grip-ez-bar-curls',
          'incline-dumbbell-curls',
          'cable-rope-overhead-triceps-extension',
          'barbell-wrist-curl',
          'hanging-leg-raise',
          'kettlebell-russian-twist',
        ],
      ],

      14 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      // ===== WEEK 3 =====
      15 => [
        'title' => 'Chest & Triceps',
        'workouts' => [
          'lever-chest-press',
          'hammer-strength-chest-press',
          'barbell-decline-bench-press',
          'dumbbell-pullover',
          'close-grip-bench-press',
          'ez-bar-seated-triceps-extension',
        ],
      ],

      16 => [
        'title' => 'Back & Biceps',
        'workouts' => [
          'lat-pulldown',
          'hammer-strength-iso-lateral-row',
          'hammer-strength-high-row',
          'supinated-grip-lat-pulldown',
          'standing-straight-arm-pulldown',
          'barbell-curl',
        ],
      ],

      17 => [
        'title' => 'Shoulders',
        'workouts' => [
          'shoulder-press-machine',
          'lateral-raise-machine',
          'landmine-press',
          'reverse-pec-deck-fly',
          'barbell-front-raise',
          'dumbbell-shrug',
        ],
      ],

      18 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      19 => [
        'title' => 'Legs',
        'workouts' => [
          'front-squat',
          'leg-press',
          'bulgarian-split-squat',
          'leg-extension',
          'barbell-romanian-deadlift',
          'standing-calf-raise',
        ],
      ],

      20 => [
        'title' => 'Arms & Core',
        'workouts' => [
          'dumbbell-skull-crusher',
          'cable-rope-overhead-triceps-extension',
          'dumbbell-hammer-curl',
          'incline-dumbbell-curls',
          'cable-knee-crunch',
          'hanging-leg-raise',
        ],
      ],

      21 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      // ===== WEEK 4 =====
      22 => [
        'title' => 'Chest & Triceps',
        'workouts' => [
          'smith-machine-bench-press',
          'smith-machine-incline-bench-press',
          'smith-machine-decline-bench-press',
          'cable-chest-fly',
          'seated-dip-machine',
          'tricep-overhead-extension',
        ],
      ],

      23 => [
        'title' => 'Back & Biceps',
        'workouts' => [
          'pull-up',
          'barbell-bent-over-row',
          'yates-row',
          'landmine-row',
          't-bar-row',
          'ez-bar-curl',
        ],
      ],

      24 => [
        'title' => 'Shoulders',
        'workouts' => [
          'dumbbell-shoulder-press',
          'dumbbell-front-raise',
          'single-arm-cable-lateral-raise',
          'cable-face-pull',
          'barbell-shoulder-press',
          'barbell-shrug',
        ],
      ],

      25 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      26 => [
        'title' => 'Legs',
        'workouts' => [
          'back-squat',
          'hack-squat',
          'leg-press',
          'barbell-deadlift',
          'dumbbell-lunge',
          'smith-machine-calf-raise',
        ],
      ],

      27 => [
        'title' => 'Arms & Core',
        'workouts' => [
          'reverse-grip-ez-bar-curls',
          'ez-bar-preacher-curl',
          'bayesian-cable-curls',
          'tricep-dips',
          'cable-crunch',
          'hanging-leg-raise',
        ],
      ],

      28 => [
        'title' => 'Rest Day',
        'workouts' => [],
      ],

      29 => [
        'title' => 'Chest & Triceps',
        'workouts' => [
          'barbell-bench-press',
          'barbell-incline-bench-press',
          'chest-dips',
          'pec-deck-fly',
          'cable-crossover',
          'barbell-skull-crusher',
        ],
      ],

      30 => [
        'title' => 'Back & Biceps',
        'workouts' => [
          'pull-up',
          'dumbbell-row',
          'cable-seated-row',
          'supinated-grip-lat-pulldown',
          'dumbbell-bicep-curl',
          'incline-dumbbell-curls',
        ],
      ],
    ];
  }


  public static function resolve(array $data): ?array
  {
    // MUSCLE GAIN - GYM - BEGINNER (RANGE SPESIFIK)
    if (
      $data['goal'] === 'muscle_gain' &&
      $data['context'] === 'gym' &&
      in_array($data['gender'], ['male', 'female']) &&
      $data['age'] >= 20 && $data['age'] <= 35 &&
      $data['height'] >= 155 && $data['height'] <= 175 &&
      $data['weight'] >= 50 && $data['weight'] <= 70 &&
      $data['level'] === 'beginner'
    ) {
      return self::muscleGainBeginner();
    }

    // BELUM ADA TEMPLATE LAIN
    return null;
  }
}
