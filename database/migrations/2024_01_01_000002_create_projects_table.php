<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // web, mobile, desktop, api, ai, iot, other
            $table->text('short_description')->nullable();
            $table->longText('description');
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable(); // Array of image paths
            $table->json('technologies')->nullable(); // Array of tech used
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('client')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->integer('order')->default(0);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('category');
            $table->index('status');
            $table->index('is_featured');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
