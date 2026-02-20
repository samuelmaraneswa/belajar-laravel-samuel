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
      Schema::create('meal_steps', function (Blueprint $table) {
        $table->id();

        $table->foreignId('meal_id')
          ->constrained('meals')
          ->cascadeOnDelete();

        $table->integer('step_number'); // urutan langkah
        $table->text('instruction');

        $table->timestamps();

        $table->unique(['meal_id', 'step_number']);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_steps');
    }
};
