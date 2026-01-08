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
      Schema::create('muscle_workout', function (Blueprint $table) {
        $table->id();

        $table->foreignId('workout_id')
          ->constrained()
          ->cascadeOnDelete();

        $table->foreignId('muscle_id')
          ->constrained()
          ->cascadeOnDelete();

        $table->enum('role', ['primary', 'secondary']);

        $table->timestamps();

        $table->unique(['workout_id', 'muscle_id', 'role']);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muscle_workout');
    }
};
