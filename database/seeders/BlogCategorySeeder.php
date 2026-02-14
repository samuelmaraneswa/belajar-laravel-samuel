<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('blog_categories')->insert([
      [
        'name' => 'Calisthenics',
        'slug' => 'calisthenics',
        'description' => 'Calisthenics journey.',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
