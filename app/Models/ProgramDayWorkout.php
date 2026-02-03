<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDayWorkout extends Model
{
  protected $table = 'program_day_workouts';

  protected $fillable = [
    'program_day_id',
    'workout_id',
    'sets',
    'reps',
    'weight',
    'duration',
    'calories',
    'order',
  ];

  public function workout()
  {
    return $this->belongsTo(Workout::class);
  }
}
