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
    Schema::create('equipments', function (Blueprint $table) {
      $table->id();
      $table->string('name');          // Dumbbell, Barbell, Pull Up Bar
      $table->string('slug')->unique(); // dumbbell, barbell, pull-up-bar
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('equipments');
  }
};
