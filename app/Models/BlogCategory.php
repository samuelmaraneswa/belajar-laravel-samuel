<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'description',
    'is_active',
  ];

  public function temas()
  {
    return $this->hasMany(BlogTema::class, 'category_id');
  }

  public function posts()
  {
    return $this->hasMany(BlogPost::class, 'category_id');
  }
}
