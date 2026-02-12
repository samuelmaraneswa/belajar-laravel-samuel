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
      Schema::table('blog_post_workout_details', function (Blueprint $table) {
        // HAPUS kolom redundant
        if (Schema::hasColumn('blog_post_workout_details', 'exercise')) {
          $table->dropColumn('exercise');
        }

        // TAMBAH kolom baru
        if (!Schema::hasColumn('blog_post_workout_details', 'weight')) {
          $table->decimal('weight', 5, 2)->nullable()->after('hold_seconds');
        }
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
