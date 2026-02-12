<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
  protected $fillable = [
    'category_id',
    'tema_id',
    'title',
    'slug',
    'excerpt',
    'content',
    'image',
    'thumb',
    'video_url',
    'status',
    'published_at',
  ];

  protected $casts = [
    'published_at' => 'datetime',
  ];

  // =====================
  // RELATIONS
  // =====================

  public function category()
  {
    return $this->belongsTo(BlogCategory::class);
  }

  public function tema()
  {
    return $this->belongsTo(BlogTema::class);
  }

  // calisthenics / workout detail (conditional)
  public function workoutDetails()
  {
    return $this->hasMany(BlogPostWorkoutDetail::class);
  }

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function isCalisthenics()
  {
    return $this->category?->slug === 'calisthenics';
  }
}
