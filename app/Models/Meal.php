<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
  protected $fillable = [
    'category_id',
    'goal_id',
    'title',
    'slug',
    'description',
    'prep_time',
    'image',
    'video_url',
  ];

  // =====================
  // RELATIONS
  // =====================

  public function category()
  {
    return $this->belongsTo(MealCategory::class, 'category_id');
  }

  public function goal()
  {
    return $this->belongsTo(MealGoal::class, 'goal_id');
  }

  public function foods()
  {
    return $this->belongsToMany(Food::class, 'meal_food')
      ->withPivot('quantity')
      ->withTimestamps();
  }
}
