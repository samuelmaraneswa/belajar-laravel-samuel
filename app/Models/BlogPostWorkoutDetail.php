<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostWorkoutDetail extends Model
{
  protected $fillable = [
    'blog_post_id',
    'progression',
    'sets',
    'reps',
    'hold_seconds',
    'weight',
  ];

  // =====================
  // RELATIONS
  // =====================
  public function post()
  {
    return $this->belongsTo(BlogPost::class, 'blog_post_id');
  }
}
