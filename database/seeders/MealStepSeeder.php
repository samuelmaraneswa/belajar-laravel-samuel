<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealStepSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('meal_steps')->insert([
      ['meal_id' => 1, 'step_number' => 1, 'instruction' => 'Potong sayur dan jagung.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'step_number' => 2, 'instruction' => 'Potong bawang dan tomat.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'step_number' => 3, 'instruction' => 'Tumis bawang dan setelah kecoklatan tambahkan air.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'step_number' => 4, 'instruction' => 'Setelah air panas, masukkan semua bahan-bahan.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'step_number' => 5, 'instruction' => 'Tutup dan biarkan selama 2 menit.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'step_number' => 6, 'instruction' => 'Tambahkan telur dan seasoning.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 1, 'step_number' => 7, 'instruction' => 'Hidangkan.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 2, 'step_number' => 1, 'instruction' => 'Haluskan 3 pisang.', 'created_at' => now(), 'updated_at' => now()],
      ['meal_id' => 2, 'step_number' => 2, 'instruction' => 'Tambahkan garam.', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}