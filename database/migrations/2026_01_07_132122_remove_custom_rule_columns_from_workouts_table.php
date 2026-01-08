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
    Schema::table('workouts', function (Blueprint $table) {
      $table->dropColumn(['is_custom', 'custom_rules']);
    });
  }

  public function down(): void
  {
    Schema::table('workouts', function (Blueprint $table) {
      $table->boolean('is_custom')->default(false);
      $table->json('custom_rules')->nullable();
    });
  }
};
