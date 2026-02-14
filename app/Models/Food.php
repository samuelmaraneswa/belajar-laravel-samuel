<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Food extends Model
{
  protected $table = 'foods';
  
  protected $fillable = [
    'name',
    'slug',
    'description',
    'image',
    'is_active',
  ];

  /**
   * 1 Food has 1 Nutrition
   */
  public function nutrition(): HasOne
  {
    return $this->hasOne(FoodNutrition::class);
  }
}
