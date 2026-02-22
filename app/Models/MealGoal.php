<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealGoal extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'description',
  ];
}
