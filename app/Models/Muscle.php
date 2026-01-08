<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
  public function workouts()
  {
    return $this->belongsToMany(Workout::class)->withPivot('role');
  }
}
