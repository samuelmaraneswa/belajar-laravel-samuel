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
      $table->string('slug')->unique();

      $table->string('type')->default('machine'); // machine | bodyweight (dipakai logic sets & reps)

      $table->foreignIdFor(WorkoutCategory::class)->constrained()->cascadeOnDelete();

      $table->text('description')->nullable();

      $table->string('image')->nullable(); // png/jpg
      $table->string('gif')->nullable();
      $table->string('image_thumb')->nullable(); // thumbnail
      $table->string('video')->nullable(); // optional

      $table->string('difficulty')->nullable(); // beginner/intermediate/advanced

      // compound | isolation
      $table->string('movement')->nullable();

      // example: 1.00, 0.70, 0.35
      $table->decimal('difficulty_factor', 3, 2)
        ->default(1.00);
        
      $table->boolean('is_active')->default(true);
      $table->unsignedInteger('order')->default(0);

      $table->timestamps();

      $table->index(['type', 'is_active']);
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
