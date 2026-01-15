<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutContext extends Model
{
  protected $fillable = [
    'name',
    'slug',
  ];

  public function workouts()
  {
    return $this->belongsToMany(Workout::class, 'workout_context_workout');
  }
}