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
    Schema::create('program_day_workouts', function (Blueprint $table) {
      $table->id();

      $table->foreignId('program_day_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->foreignId('workout_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->unsignedTinyInteger('sets')->nullable();
      $table->string('reps', 20)->nullable();
      $table->unsignedSmallInteger('weight')->nullable();
      $table->unsignedSmallInteger('duration')->nullable(); // menit
      $table->unsignedSmallInteger('calories')->nullable();

      $table->unsignedTinyInteger('order')->default(1);

      $table->timestamps();
    });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_days_workouts');
    }
};
