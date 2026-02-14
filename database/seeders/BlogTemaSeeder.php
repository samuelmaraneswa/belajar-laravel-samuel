<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogTema;

class BlogTemaSeeder extends Seeder
{
  public function run(): void
  {
    BlogTema::insert([
      [
        'category_id' => 1,
        'name' => 'Handstand',
        'slug' => 'handstand',
        'description' => 'Follow me to see my handstand journey.',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'category_id' => 1,
        'name' => 'Planche',
        'slug' => 'planche',
        'description' => 'Follow me to see my full planche journey.',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
