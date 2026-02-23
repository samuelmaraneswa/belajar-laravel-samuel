<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealStep extends Model
{
  protected $fillable = [
    'meal_id',
    'step_number',
    'instruction',
  ];

  public function meal()
  {
    return $this->belongsTo(Meal::class);
  }
}
