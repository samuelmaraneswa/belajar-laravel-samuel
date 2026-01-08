<?php

use App\Models\WorkoutCategory;
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
    Schema::create('workouts', function (Blueprint $table) {
      $table->id();
      $table->string('title');

      $table->foreignIdFor(WorkoutCategory::class)->constrained()->cascadeOnDelete();

      $table->text('description')->nullable();
      $table->string('image')->nullable();
      $table->string('image_thumb')->nullable();
      $table->string('video')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('workouts');
  }
};
