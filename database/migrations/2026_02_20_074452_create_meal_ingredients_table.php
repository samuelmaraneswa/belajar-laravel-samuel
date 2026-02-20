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
    Schema::create('meal_ingredients', function (Blueprint $table) {
      $table->id();

      $table->foreignId('meal_id')
        ->constrained('meals')
        ->cascadeOnDelete();

      $table->foreignId('ingredient_id')
        ->constrained('ingredients')
        ->cascadeOnDelete();

      $table->decimal('quantity', 8, 2);
      // contoh: 150.00 (gram) atau 2.00 (pcs)

      $table->string('unit');
      // bisa override default_unit jika perlu

      $table->timestamps();

      $table->unique(['meal_id', 'ingredient_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_ingredients');
    }
};
