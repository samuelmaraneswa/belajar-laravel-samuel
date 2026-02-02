<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
  public function run(): void
  {
    $equipments = [
      [1, 'Bodyweight', 'bodyweight', '2026-01-14 09:33:15'],
      [2, 'Pull Up Bar', 'pull-up-bar', '2026-01-14 09:33:15'],
      [3, 'Dumbbell', 'dumbbell', '2026-01-14 09:33:15'],
      [4, 'Barbell', 'barbell', '2026-01-14 09:33:15'],
      [5, 'Bench', 'bench', '2026-01-14 09:33:15'],
      [6, 'Kettlebell', 'kettlebell', '2026-01-14 09:33:15'],
      [7, 'Resistance Band', 'resistance-band', '2026-01-14 09:33:15'],
      [8, 'Cable Machine', 'cable-machine', '2026-01-14 09:33:15'],
      [9, 'Smith Machine', 'smith-machine', '2026-01-14 09:33:15'],
      [10, 'Medicine Ball', 'medicine-ball', '2026-01-14 09:33:15'],
      [11, 'Lateral Raise Machine', 'lateral-raise-machine', null],
      [12, 'Assisted Weight Machine', 'assisted-weight-machine', null],
      [13, 'Stability Ball', 'stability-ball', null],
      [15, 'Triceps Bar', 'triceps-bar', null],
      [16, 'Peck Deck Machine', 'peck-deck-machine', null],
      [17, 'Ez Bar', 'ez-bar', null],
      [18, 'Leg Press', 'leg-press', null],
      [19, 'Leg Extension Machine', 'leg-extension-machine', null],
      [20, 'High Row Machine', 'high-row-machine', null],
      [21, 'Shoulder Press Machine', 'shoulder-press-machine', null],
      [22, 'Captain\'s Chair', 'captains-chair', null],
      [24, 'Lever Preacher Machine', 'lever-preacher-machine', null],
      [25, 'Hack Squat Machine', 'hack-squat-machine', null],
      [26, 'Leg Curl Machine', 'leg-curl-machine', null],
      [27, 'Thigh Abductor Machine', 'thigh-abductor-machine', null],
      [28, 'Hammer Strength Machine', 'hammer-strength-machine', null],
      [29, 'Lever Chest Press', 'lever-chest-machine', null],
      [30, 'T-Bar Row', 't-bar-row', null],
      [31, 'Chest-Supported Row Machine', 'chest-supported-row-machine', null],
      [32, 'Hammer Strength Iso-Lateral Row Machine', 'hammer-strength-iso-lateral-row-machine', null],
      [33, 'Landmine', 'landmine', null],
      [34, 'Squat Rack', 'squat-rack', null],
      [35, 'Calf Raise Machine', 'calf-raise-machine', null],
      [36, 'Seated Dip Machine', 'seated-dip-machine', null],
    ];

    foreach ($equipments as [$id, $name, $slug, $timestamp]) {
      Equipment::updateOrCreate(
        ['id' => $id],
        [
          'name' => $name,
          'slug' => $slug,
          'created_at' => $timestamp,
          'updated_at' => $timestamp,
        ]
      );
    }
  }
}
