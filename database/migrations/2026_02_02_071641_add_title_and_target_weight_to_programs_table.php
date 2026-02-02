<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
  {
    Schema::table('programs', function (Blueprint $table) {
      $table->string('title')->after('user_id');
      $table->integer('target_weight')->after('weight');
    });
  }

  public function down()
  {
    Schema::table('programs', function (Blueprint $table) {
      $table->dropColumn(['title', 'target_weight']);
    });
  }
};
