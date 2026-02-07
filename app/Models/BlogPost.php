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
    'status',
    'published_at',
  ];

  protected $casts = [
    'published_at' => 'datetime',
  ];

  public function category()
  {
    return $this->belongsTo(BlogCategory::class, 'category_id');
  }

  public function tema()
  {
    return $this->belongsTo(BlogTema::class, 'tema_id');
  }
}
