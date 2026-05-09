<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Pengurus OSIS, Dewan Galang, etc
            $table->string('type'); // organization, internship, extracurricular
            $table->string('organization'); // SMPN 1 SLAHUNG, etc
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->string('start_year');
            $table->string('end_year')->nullable(); // null = Now/Present
            $table->boolean('is_current')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
