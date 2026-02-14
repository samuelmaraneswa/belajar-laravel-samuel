<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('food_nutritions', function (Blueprint $table) {
      $table->id();

      $table->foreignId('food_id')
        ->constrained('foods')
        ->cascadeOnDelete()
        ->unique(); // 1 food = 1 nutrition

      // Base serving
      $table->decimal('serving_base_gram', 8, 2)->default(100);

      /*
      |--------------------------------------------------------------------------
      | Macronutrients
      |--------------------------------------------------------------------------
      */
      $table->decimal('calories_kcal', 8, 2)->nullable();
      $table->decimal('protein_g', 8, 2)->nullable();
      $table->decimal('fat_g', 8, 2)->nullable();
      $table->decimal('carbs_g', 8, 2)->nullable();
      $table->decimal('fiber_g', 8, 2)->nullable();
      $table->decimal('sugar_g', 8, 2)->nullable();
      $table->decimal('water_g', 8, 2)->nullable();
      $table->decimal('alcohol_g', 8, 2)->nullable();

      /*
      |--------------------------------------------------------------------------
      | Fat Detail
      |--------------------------------------------------------------------------
      */
      $table->decimal('saturated_fat_g', 8, 2)->nullable();
      $table->decimal('monounsaturated_fat_g', 8, 2)->nullable();
      $table->decimal('polyunsaturated_fat_g', 8, 2)->nullable();
      $table->decimal('trans_fat_g', 8, 2)->nullable();
      $table->decimal('cholesterol_mg', 8, 2)->nullable();

      /*
      |--------------------------------------------------------------------------
      | Minerals
      |--------------------------------------------------------------------------
      */
      $table->decimal('sodium_mg', 8, 2)->nullable();
      $table->decimal('potassium_mg', 8, 2)->nullable();
      $table->decimal('calcium_mg', 8, 2)->nullable();
      $table->decimal('iron_mg', 8, 2)->nullable();
      $table->decimal('magnesium_mg', 8, 2)->nullable();
      $table->decimal('zinc_mg', 8, 2)->nullable();

      /*
      |--------------------------------------------------------------------------
      | Vitamins
      |--------------------------------------------------------------------------
      */
      $table->decimal('vitamin_a_mcg', 8, 2)->nullable();
      $table->decimal('vitamin_b1_mg', 8, 2)->nullable();
      $table->decimal('vitamin_b2_mg', 8, 2)->nullable();
      $table->decimal('vitamin_b3_mg', 8, 2)->nullable();
      $table->decimal('vitamin_b6_mg', 8, 2)->nullable();
      $table->decimal('vitamin_b12_mcg', 8, 2)->nullable();
      $table->decimal('vitamin_c_mg', 8, 2)->nullable();
      $table->decimal('vitamin_d_mcg', 8, 2)->nullable();
      $table->decimal('vitamin_e_mg', 8, 2)->nullable();
      $table->decimal('vitamin_k_mcg', 8, 2)->nullable();
      $table->decimal('folate_mcg', 8, 2)->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('food_nutritions');
  }
};
