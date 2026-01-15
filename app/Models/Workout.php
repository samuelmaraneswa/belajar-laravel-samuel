<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
  protected $fillable = [
    'title',
    'slug',
    'workout_category_id',
    'type',
    'description',
    'image',
    'image_thumb',
    'gif',
    'video',
    'difficulty',
    'movement',
    'difficulty_factor'
  ];

  public function category()
  {
    return $this->belongsTo(WorkoutCategory::class, 'workout_category_id');
  }

  public function muscles()
  {
    return $this->belongsToMany(Muscle::class)->withPivot('role');
  }

  public function contexts()
  {
    return $this->belongsToMany(WorkoutContext::class, 'workout_context_workout');
  }

  public function equipments()
  {
    return $this->belongsToMany(Equipment::class);
  }

  public function instructions()
  {
    return $this->hasMany(WorkoutInstruction::class)
      ->orderBy('step');
  }
}
