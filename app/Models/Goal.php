<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
  protected $table = 'meal_goals'; 

  protected $fillable = [
    'name',
    'slug',
  ];

  public function meals()
  {
    return $this->hasMany(Meal::class);
  }
}
