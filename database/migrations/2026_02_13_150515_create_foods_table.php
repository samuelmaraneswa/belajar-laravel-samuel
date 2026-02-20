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
    Schema::create('foods', function (Blueprint $table) {
      $table->id();

      $table->string('name');
      $table->string('slug')->unique();

      $table->text('description')->nullable();
      $table->string('image')->nullable();

      /*
    |--------------------------------------------------------------------------
    | Serving Configuration (Natural Serving Based)
    |--------------------------------------------------------------------------
    */
      $table->decimal('serving_base_value', 8, 2);
      $table->string('serving_unit', 20);
      // contoh: g, ml, pcs, tbsp, tsp

      $table->decimal('density', 8, 4)->nullable();
      // optional: hanya dipakai jika ingin konversi ml -> gram

      $table->boolean('is_active')->default(true);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('foods');
  }
};
