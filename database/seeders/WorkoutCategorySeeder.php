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
        [
          'name' => 'Full Body',
          'description' => 'Latihan yang melatih hampir semua kelompok otot utama (kaki, punggung, dada, bahu, lengan, perut) dalam satu sesi latihan, ideal untuk pemula atau yang punya waktu terbatas karena efisien, meningkatkan pembakaran kalori, dan membantu belajar teknik dasar dengan gerakan majemuk (compound movements) seperti squat, deadlift, dan push-up'
        ],
        [
          'name' => 'Mobility',
          'description' => 'Latihan yang berfokus pada peningkatan rentang gerak sendi (range of motion) secara dinamis dan terkontrol, berbeda dengan fleksibilitas yang hanya meregangkan otot'
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
