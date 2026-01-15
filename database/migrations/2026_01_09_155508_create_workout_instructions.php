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
    Schema::create('workout_instructions', function (Blueprint $table) {
      $table->id();

      $table->foreignId('workout_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->unsignedInteger('step'); // 1,2,3
      $table->text('instruction');

      $table->timestamps();

      $table->unique(['workout_id', 'step']);
    });
  }

    /**
     * Reverse the migrations.
     */
  public function down(): void
  {
    Schema::dropIfExists('workout_instructions');
  }
};
