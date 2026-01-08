<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutCategory extends Model
{
  protected $fillable = ['name', 'description'];

  public function workouts()
  {
    return $this->hasMany(Workout::class, 'workout_category_id');
  }
}
