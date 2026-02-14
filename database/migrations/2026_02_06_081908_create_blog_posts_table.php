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
      Schema::create('blog_posts', function (Blueprint $table) {
        $table->id();

        $table->foreignId('category_id')
          ->constrained('blog_categories')
          ->cascadeOnDelete();

        $table->foreignId('tema_id')
          ->constrained('blog_tema')
          ->cascadeOnDelete();

        $table->string('title');
        $table->string('slug')->unique();

        $table->string('thumb')->nullable();
        $table->string('image')->nullable();
        $table->string('video_url')->nullable();

        $table->text('excerpt')->nullable();   // ringkasan
        $table->longText('content');           // isi journey

        $table->enum('status', ['draft', 'published'])->default('draft');
        $table->timestamp('published_at')->nullable();

        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
