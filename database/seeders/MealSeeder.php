<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('meals')->insert([
      [
        'id' => 1,
        'category_id' => 1,
        'goal_id' => 3,
        'title' => 'Sayur Kacang Panjang + Jagung',
        'slug' => 'sayur-kacang-panjang-jagung-o0kWL',
        'description' => 'Sayur kacang panjang plus jagung untuk maintenance berat badan.',
        'prep_time' => 7,
        'image' => 'meals/B251miGvdXw5IDAlsua1vtbAh1q0D0IeBTBSHyaD.jpg',
        'video_url' => 'https://youtu.be/vq5_XbzMiOI',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 2,
        'category_id' => 2,
        'goal_id' => 1,
        'title' => 'Bolu Pisang',
        'slug' => 'bolu-pisang-70jkg',
        'description' => 'Bolu pisang untuk bulking.',
        'prep_time' => 50,
        'image' => 'meals/J3TqXwj2JGeAXvvoVXIPC5lbSvDTsq86vUkpxQm3.jpg',
        'video_url' => 'https://youtube.com/shorts/2Vs4SYGmMgQ?feature=share',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}