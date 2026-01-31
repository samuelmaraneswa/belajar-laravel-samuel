<?php

namespace App\Services;

use App\Models\Workout;

class ProgramGeneratorService
{
  public function generate(array $profile): array
  {
    // 1. Ambil template dari Excel (hardcode)
    $template = ProgramTemplates::muscleGainBeginner();

    // 2. Ambil semua workout yang dipakai template (sekali query)
    $allSlugs = collect($template)
      ->flatten()
      ->filter()
      ->unique()
      ->values();

    $workouts = Workout::whereIn('slug', $allSlugs)->get()->keyBy('slug');

    // 3. Bangun 30 hari
    return $this->buildDaysFromTemplate($template, $workouts, $profile);
  }

  protected function buildDaysFromTemplate(
    array $template,
    $workouts,
    array $profile
  ): array {
    $days = [];

    foreach ($template as $day => $slugs) {

      // REST DAY
      if (empty($slugs)) {
        $days[$day] = ['rest' => true];
        continue;
      }

      $dailyWorkouts = collect($slugs)
        ->map(fn($slug) => $workouts->get($slug))
        ->filter(); // aman kalau ada slug belum ada di DB

      $days[$day] = [
        'rest' => false,
        'workouts' => $this->calculateWorkouts($dailyWorkouts, $profile),
      ];
    }

    return $days;
  }

  protected function calculateWorkouts($workouts, array $profile): array
  {
    return $workouts->map(function ($workout) use ($profile) {
      $calc = WorkoutCalculator::calculate($profile, $workout);

      // 🔥 AMAN: pilih level jika ada, kalau tidak ambil yang pertama
      $plan = $calc[$profile['level']]
        ?? reset($calc);

      return [
        'workout' => $workout,
        'plan' => $plan,
      ];
    })->toArray();
  }
}
