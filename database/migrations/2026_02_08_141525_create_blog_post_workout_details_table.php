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
      Schema::create('blog_post_workout_details', function (Blueprint $table) {
        $table->id();

        $table->foreignId('blog_post_id')
          ->constrained('blog_posts')
          ->cascadeOnDelete();

        $table->string('progression')->nullable();  // wall handstand, tuck, dll

        $table->integer('sets')->nullable();
        $table->integer('reps')->nullable();
        $table->integer('hold_seconds')->nullable(); // untuk static hold
        $table->decimal('weight', 5, 2)->nullable();

        $table->text('notes')->nullable();           // catatan hari itu

        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post_workout_details');
    }
};
