<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPostWorkoutDetail;

class BlogPostWorkoutDetailSeeder extends Seeder
{
  public function run(): void
  {
    BlogPostWorkoutDetail::insert([
      // Post 1 - Handstand
      [
        'blog_post_id' => 1,
        'progression' => 'Hs attempt',
        'sets' => 4,
        'reps' => 3,
        'hold_seconds' => null,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'blog_post_id' => 1,
        'progression' => 'Hs hold',
        'sets' => 4,
        'reps' => 3,
        'hold_seconds' => 15,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'blog_post_id' => 1,
        'progression' => 'HSPU-Wall',
        'sets' => 4,
        'reps' => 2,
        'hold_seconds' => null,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'blog_post_id' => 1,
        'progression' => 'Pike pushup',
        'sets' => 4,
        'reps' => 8,
        'hold_seconds' => null,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'blog_post_id' => 1,
        'progression' => 'Push up',
        'sets' => 4,
        'reps' => 25,
        'hold_seconds' => null,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Post 2 - Planche Day 1
      [
        'blog_post_id' => 2,
        'progression' => 'Planche lean.',
        'sets' => 4,
        'reps' => 3,
        'hold_seconds' => 3,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'blog_post_id' => 2,
        'progression' => 'Tuck planche',
        'sets' => 4,
        'reps' => 3,
        'hold_seconds' => 3,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Post 3 - Planche Day 2
      [
        'blog_post_id' => 3,
        'progression' => 'Planche Lean.',
        'sets' => 4,
        'reps' => 3,
        'hold_seconds' => 3,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'blog_post_id' => 3,
        'progression' => 'Tuck Planche',
        'sets' => 4,
        'reps' => 3,
        'hold_seconds' => 3,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'blog_post_id' => 3,
        'progression' => 'Advanced Tuck Attempt',
        'sets' => 4,
        'reps' => 3,
        'hold_seconds' => null,
        'weight' => null,
        'notes' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
