<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodNutrition extends Model
{
  protected $table = 'food_nutritions';
  
  protected $fillable = [
    'food_id',
    'serving_base_gram',
    'calories_kcal',
    'protein_g',
    'fat_g',
    'carbs_g',
    'fiber_g',
    'sugar_g',
    'water_g',
    'alcohol_g',
    'saturated_fat_g',
    'monounsaturated_fat_g',
    'polyunsaturated_fat_g',
    'trans_fat_g',
    'cholesterol_mg',
    'sodium_mg',
    'potassium_mg',
    'calcium_mg',
    'iron_mg',
    'magnesium_mg',
    'zinc_mg',
    'vitamin_a_mcg',
    'vitamin_b1_mg',
    'vitamin_b2_mg',
    'vitamin_b3_mg',
    'vitamin_b6_mg',
    'vitamin_b12_mcg',
    'vitamin_c_mg',
    'vitamin_d_mcg',
    'vitamin_e_mg',
    'vitamin_k_mcg',
    'folate_mcg',
  ];

  /**
   * Nutrition belongs to Food
   */
  public function food(): BelongsTo
  {
    return $this->belongsTo(Food::class);
  }
}
