<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDayWorkoutSet extends Model
{
  protected $fillable = [
    'user_id',
    'program_day_workout_id',
    'set_number',
    'completed_at',
  ];

  protected $casts = [
    'completed_at' => 'datetime',
  ];
}
