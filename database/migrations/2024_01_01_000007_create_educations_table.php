<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('level'); // SD, SMP, SMK, UNIVERSITAS
            $table->string('institution'); // SDN 4 SLAHUNG, etc
            $table->string('major')->nullable(); // Jurusan (for SMK/University)
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->string('start_year');
            $table->string('end_year')->nullable();
            $table->boolean('is_current')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
