<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('projects_id')->nullable();
            $table->json('title');
            $table->json('slug');
            $table->json('introduction');
            $table->json('content');
            $table->string('image_file_path');
            $table->json('caption')->nullable();
            $table->boolean('is_public');
            $table->dateTime('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_posts');
    }
};
