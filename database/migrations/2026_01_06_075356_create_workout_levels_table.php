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
    Schema::create('workout_levels', function (Blueprint $table) {
      $table->id();
      $table->foreignId('workout_id')->constrained()->cascadeOnDelete();

      $table->enum('level', ['beginner', 'intermediate', 'advanced']);
      $table->unsignedTinyInteger('sets');
      $table->unsignedTinyInteger('reps_min');
      $table->unsignedTinyInteger('reps_max');

      // hanya untuk machine workout
      $table->decimal('weight_percent', 4, 2)->nullable();
      
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('workout_levels');
  }
};
