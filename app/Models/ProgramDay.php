<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDay extends Model
{
  protected $fillable = [
    'program_id',
    'day',
    'is_rest',
  ];

  public function workouts()
  {
    return $this->hasMany(ProgramDayWorkout::class);
  }
}
