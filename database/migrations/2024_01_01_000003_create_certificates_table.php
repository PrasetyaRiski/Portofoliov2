<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('issuer'); // e.g., Google, AWS, Dicoding
            $table->string('category'); // programming, cloud, security, etc.
            $table->text('description')->nullable();
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->string('credential_id')->nullable();
            $table->string('credential_url')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('certificate_image')->nullable();
            $table->json('skills_covered')->nullable(); // Related skills
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('category');
            $table->index('issuer');
            $table->index('is_featured');
            $table->index('issue_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
