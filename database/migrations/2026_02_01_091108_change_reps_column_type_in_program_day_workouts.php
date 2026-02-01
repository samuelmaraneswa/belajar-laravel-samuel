<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::table('program_day_workouts', function (Blueprint $table) {
      $table->string('reps', 20)->nullable()->change();
    });
  }

  public function down(): void
  {
    Schema::table('program_day_workouts', function (Blueprint $table) {
      $table->unsignedTinyInteger('reps')->nullable()->change();
    });
  }
};
