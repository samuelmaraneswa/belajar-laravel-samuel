<?php

namespace App\Services;

class ProgramTemplates
{
  public static function muscleGainBeginner(): array
  {
    return [

      // ===== WEEK 1 =====
      1 => [
        'barbell-bench-press',
        'barbell-incline-bench-press',
        'chest-dips',
        'pec-deck-fly',
        'cable-straight-bar-tricep-pushdown',
        'cable-rope-overhead-triceps-extension',
      ],

      2 => [
        'lat-pulldown',
        'cable-seated-row',
        'neutral-lat-pulldown',
        'supinated-grip-lat-pulldown',
        'ez-bar-curl',
        'dumbbell-bicep-curl',
        'straight-arm-lat-pushdown',
      ],

      3 => [
        'back-squat',
        'leg-press',
        'barbell-deadlift',
        'leg-extension',
        'smith-machine-calf-raise',
      ],

      4 => [], // rest

      5 => [
        'dumbbell-shoulder-press',
        'dumbbell-lateral-raise',
        'dumbbell-rear-delt-row',
        'machine-shoulder-press',
        'dumbbell-front-raise',
        'barbell-shrug',
      ],

      6 => [
        'dumbbell-wrist-curl',
        'dumbbell-reverse-wrist-curl',
        'barbell-skull-crusher',
        'dumbbell-hammer-curl',
        'cable-crunch',
        'captains-chair-leg-raises',
      ],

      7 => [], // rest

      // ===== WEEK 2 =====
      8 => [
        'dumbbell-bench-press',
        'dumbbell-incline-bench-press',
        'smith-machine-decline-bench-press',
        'dumbbell-fly',
        'rope-triceps-pushdown',
        'cable-rope-overhead-triceps-extension',
      ],

      9 => [
        'assisted-pull-up',
        'dumbbell-row',
        'barbell-bent-over-row',
        'yates-row',
        'dumbbell-bicep-curl',
        'lever-preacher-curl',
      ],

      10 => [
        'barbell-shoulder-press',
        'lateral-raise-machine',
        'shoulder-press-machine',
        'dumbbell-rear-delt-fly',
        'dumbbell-front-raise',
        'cable-upright-row',
      ],

      11 => [], // rest

      12 => [
        'hack-squat',
        'seated-leg-curl',
        'barbell-romanian-deadlift',
        'hip-adduction',
        'hip-abduction',
        'smith-machine-calf-raise',
      ],

      13 => [
        'reverse-grip-ez-bar-curls',
        'incline-dumbbell-curls',
        'cable-rope-overhead-triceps-extension',
        'barbell-wrist-curl',
        'hanging-leg-raise',
        'kettlebell-russian-twist',
      ],

      14 => [], // rest

      // ===== WEEK 3 =====
      15 => [
        'lever-chest-press',
        'hammer-strength-chest-press',
        'barbell-decline-bench-press',
        'dumbbell-pullover',
        'close-grip-bench-press',
        'ez-bar-seated-triceps-extension',
      ],

      16 => [
        'lat-pulldown',
        'hammer-strength-iso-lateral-row',
        'hammer-strength-high-row',
        'supinated-grip-lat-pulldown',
        'standing-straight-arm-pulldown',
        'barbell-curl',
      ],

      17 => [
        'shoulder-press-machine',
        'lateral-raise-machine',
        'landmine-press',
        'reverse-pec-deck-fly',
        'barbell-front-raise',
        'dumbbell-shrug',
      ],

      18 => [], // rest

      19 => [
        'front-squat',
        'leg-press',
        'bulgarian-split-squat',
        'leg-extension',
        'barbell-romanian-deadlift',
        'standing-calf-raise',
      ],

      20 => [
        'dumbbell-skull-crusher',
        'cable-rope-overhead-triceps-extension',
        'dumbbell-hammer-curl',
        'incline-dumbbell-curls',
        'cable-knee-crunch',
        'hanging-leg-raise',
      ],

      21 => [], // rest

      // ===== WEEK 4 =====
      22 => [
        'smith-machine-bench-press',
        'smith-machine-incline-bench-press',
        'smith-machine-decline-bench-press',
        'cable-chest-fly',
        'seated-dip-machine',
        'tricep-overhead-extension',
      ],

      23 => [
        'pull-up',
        'barbell-bent-over-row',
        'yates-row',
        'landmine-row',
        't-bar-row',
        'ez-bar-curl',
      ],

      24 => [
        'dumbbell-shoulder-press',
        'dumbbell-front-raise',
        'single-arm-cable-lateral-raise',
        'cable-face-pull',
        'barbell-shoulder-press',
        'barbell-shrug',
      ],

      25 => [], // rest

      26 => [
        'back-squat',
        'hack-squat',
        'leg-press',
        'barbell-deadlift',
        'dumbbell-lunge',
        'smith-machine-calf-raise',
      ],

      27 => [
        'reverse-grip-ez-bar-curls',
        'ez-bar-preacher-curl',
        'bayesian-cable-curls',
        'tricep-dips',
        'cable-crunch',
        'hanging-leg-raise',
      ],

      28 => [], // rest

      29 => [
        'barbell-bench-press',
        'barbell-incline-bench-press',
        'chest-dips',
        'pec-deck-fly',
        'cable-crossover',
        'barbell-skull-crusher',
      ],

      30 => [
        'pull-up',
        'dumbbell-row',
        'cable-seated-row',
        'supinated-grip-lat-pulldown',
        'dumbbell-bicep-curl',
        'incline-dumbbell-curls',
      ],
    ];
  }
}
