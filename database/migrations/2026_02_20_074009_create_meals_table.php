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
      Schema::create('meals', function (Blueprint $table) {
        $table->id();

        // Relasi
        $table->foreignId('category_id')
          ->constrained('meal_categories')
          ->cascadeOnDelete();

        $table->foreignId('goal_id')
          ->nullable()
          ->constrained('meal_goals')
          ->nullOnDelete();

        // Basic Info
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('description');

        // Nutrition (per serving)
        $table->integer('calories');
        $table->integer('protein'); // gram
        $table->integer('carbs');   // gram
        $table->integer('fats');    // gram

        // Estimasi
        $table->integer('prep_time')->nullable(); // menit

        // Media
        $table->string('image')->nullable();
        $table->string('video_url')->nullable();

        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
