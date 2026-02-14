<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class BlogPostSeeder extends Seeder
{
  public function run(): void
  {
    BlogPost::insert([
      [
        'category_id' => 1,
        'tema_id' => 1,
        'title' => 'Day 1: Handstand',
        'slug' => 'day-1-handstand',
        'thumb' => 'blog/thumb/Dbbcn5tKaXQOgVRaMzxbhbzAvacLZzY2GhFe5MkJ.webp',
        'image' => 'blog/posts/Dbbcn5tKaXQOgVRaMzxbhbzAvacLZzY2GhFe5MkJ.jpg',
        'video_url' => 'https://youtu.be/Ey-FbenA4zk',
        'excerpt' => null,
        'content' => "Fokus handstand dan push.\nWorkout progression bisa di lihat di tabel.\nWaktu yang di perlukan sekitar 1 jam 20 menit.",
        'status' => 'published',
        'published_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'category_id' => 1,
        'tema_id' => 2,
        'title' => 'Day 1: Planche',
        'slug' => 'day-1-planche',
        'thumb' => 'blog/thumb/dJY8KNrA8739YnMEJxLeElaCArTqGOkABtz3bohg.webp',
        'image' => 'blog/posts/dJY8KNrA8739YnMEJxLeElaCArTqGOkABtz3bohg.jpg',
        'video_url' => 'https://youtu.be/eVxjtDG4dqE',
        'excerpt' => null,
        'content' => "Just do the work!",
        'status' => 'published',
        'published_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'category_id' => 1,
        'tema_id' => 2,
        'title' => 'Day 2: Planche',
        'slug' => 'day-2-planche',
        'thumb' => 'blog/thumb/gKbEZuIRtHJp6sE7UpMZsJdOKMoGvfdBPdEEUa9l.webp',
        'image' => 'blog/posts/gKbEZuIRtHJp6sE7UpMZsJdOKMoGvfdBPdEEUa9l.jpg',
        'video_url' => 'https://youtu.be/Fc2JGd30IbM',
        'excerpt' => null,
        'content' => "Coba latihan tuck planche ke advanced planche.\nWorkout progression ada di tabel.\nwaktu yang saya pakai sekitar 1 jam 30 menit.",
        'status' => 'published',
        'published_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
