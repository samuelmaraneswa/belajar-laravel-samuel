<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutInstruction extends Model
{
  protected $fillable = [
    'workout_id',
    'step',
    'instruction',
  ];

  public function workout()
  {
    return $this->belongsTo(Workout::class);
  }
}