<?php

namespace Database\Seeders;

use App\Models\WorkoutCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $categories = [
        [
          'name' => 'Push',
          'description' => 'Latihan otot dorong seperti dada, bahu, dan trisep'
        ],
        [
          'name' => 'Pull',
          'description' => 'Latihan otot tarik seperti punggung dan bisep'
        ],
        [
          'name' => 'Legs',
          'description' => 'Latihan otot kaki seperti paha dan betis'
        ],
        [
          'name' => 'Cardio',
          'description' => 'Latihan untuk meningkatkan detak jantung dan stamina'
        ],
        [
          'name' => 'Core',
          'description' => 'Latihan otot perut dan stabilitas tubuh'
        ],
      ];

      foreach ($categories as $cat) {
        WorkoutCategory::firstOrCreate(
          ['name' => $cat['name']],
          $cat
        );
      }
    }
}
