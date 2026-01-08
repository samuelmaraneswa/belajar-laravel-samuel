<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
  protected $fillable = [
    'title',
    'workout_category_id',
    'type',
    'description',
    'image',
    'image_thumb',
    'video',
  ];

  public function category()
  {
    return $this->belongsTo(WorkoutCategory::class, 'workout_category_id');
  }

  public function muscles()
  {
    return $this->belongsToMany(Muscle::class)->withPivot('role');
  }
}
