<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // frontend, backend, mobile, database, devops, tools, soft-skill
            $table->tinyInteger('level')->default(50); // 1-100
            $table->string('icon')->nullable(); // Font Awesome icon or SVG path
            $table->string('color')->nullable(); // Brand color
            $table->text('description')->nullable();
            $table->integer('years_experience')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();

            // Indexes
            $table->index('category');
            $table->index('is_featured');
            $table->index('level');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
