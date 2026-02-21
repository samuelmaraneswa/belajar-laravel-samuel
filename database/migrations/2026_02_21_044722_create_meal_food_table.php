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
      Schema::create('meal_food', function (Blueprint $table) {
        $table->id();

        $table->foreignId('meal_id')
          ->constrained('meals')
          ->cascadeOnDelete();

        $table->foreignId('food_id')
          ->constrained('foods')
          ->cascadeOnDelete();

        $table->decimal('quantity', 8, 2);
        // contoh: 350 (gram), 2 (pcs)

        $table->timestamps();

        $table->unique(['meal_id', 'food_id']);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_food');
    }
};
