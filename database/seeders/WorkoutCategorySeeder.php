<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutCategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('workout_categories')->insert([
      [
        'id' => 1,
        'name' => 'Push',
        'description' => 'Latihan otot dorong seperti dada, bahu, dan trisep',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 2,
        'name' => 'Pull',
        'description' => 'Latihan otot tarik seperti punggung dan bisep',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 3,
        'name' => 'Legs',
        'description' => 'Latihan otot kaki seperti paha dan betis',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 4,
        'name' => 'Cardio',
        'description' => 'Latihan untuk meningkatkan detak jantung dan stamina',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 5,
        'name' => 'Core',
        'description' => 'Latihan otot perut dan stabilitas tubuh',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 6,
        'name' => 'Full Body',
        'description' => 'Latihan yang melatih hampir semua kelompok otot utama (kaki, punggung, dada, bahu, lengan, perut) dalam satu sesi latihan, ideal untuk pemula atau yang punya waktu terbatas karena efisien, meningkatkan pembakaran kalori, dan membantu belajar teknik dasar dengan gerakan majemuk (compound movements) seperti squat, deadlift, dan push-up',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 7,
        'name' => 'Mobility',
        'description' => 'Latihan yang berfokus pada peningkatan rentang gerak sendi (range of motion) secara dinamis dan terkontrol, berbeda dengan fleksibilitas yang hanya meregangkan otot',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
    ]);
  }
}
