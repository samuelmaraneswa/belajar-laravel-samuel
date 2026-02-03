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
    Schema::create('program_day_workout_sets', function (Blueprint $table) {
      $table->id();

      $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->foreignId('program_day_workout_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->unsignedTinyInteger('set_number');

      $table->timestamp('completed_at')->nullable();

      $table->timestamps();

      $table->unique(
        ['user_id', 'program_day_workout_id', 'set_number'],
        'unique_user_workout_set'
      );
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('program_day_workout_sets');
  }
};
