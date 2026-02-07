<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTema extends Model
{
  protected $table = 'blog_tema';

  protected $fillable = [
    'category_id',
    'name',
    'slug',
    'description',
    'is_active',
  ];

  public function category()
  {
    return $this->belongsTo(BlogCategory::class, 'category_id');
  }

  public function posts()
  {
    return $this->hasMany(BlogPost::class, 'tema_id');
  }
}
