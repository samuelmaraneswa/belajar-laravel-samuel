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

        $table->foreignId('category_id')
          ->constrained('meal_categories')
          ->cascadeOnDelete();

        $table->foreignId('goal_id')
          ->nullable()
          ->constrained('meal_goals')
          ->nullOnDelete();

        $table->string('title');
        $table->string('slug')->unique();
        $table->text('description');

        $table->integer('prep_time')->nullable();

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
