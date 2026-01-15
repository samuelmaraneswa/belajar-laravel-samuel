<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
  protected $table = 'equipments';
  
  protected $fillable = [
    'name',
    'slug',
  ];

  public function workouts()
  {
    return $this->belongsToMany(Workout::class);
  }
}