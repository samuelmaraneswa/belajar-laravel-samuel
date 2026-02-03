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
    Schema::create('programs', function (Blueprint $table) {
      $table->id();

      $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

      // ✅ IDENTITAS PROGRAM
      $table->string('title');
      $table->string('goal');          // bulking | cutting | maintenance
      $table->string('context');       // home | gym | calisthenics

      // ✅ PROFIL USER SAAT GENERATE
      $table->string('gender');        // male | female
      $table->unsignedTinyInteger('age');
      $table->unsignedSmallInteger('height'); // cm
      $table->unsignedSmallInteger('weight'); // kg
      $table->unsignedSmallInteger('target_weight'); // kg
      $table->string('level');         // beginner | intermediate | advanced

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
      Schema::dropIfExists('programs');
  }
};
