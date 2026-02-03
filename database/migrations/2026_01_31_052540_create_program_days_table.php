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
    Schema::create('program_days', function (Blueprint $table) {
      $table->id();

      $table->foreignId('program_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->unsignedTinyInteger('day'); // 1–30
      $table->string('title')->nullable(); // ✅ PINDAH KE SINI
      $table->boolean('is_rest')->default(false);

      $table->timestamps();

      $table->unique(['program_id', 'day']);
    });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_days');
    }
};
