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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Album Galeri (misal: Kegiatan Ramadhan 2024)
            $table->string('slug')->unique(); // Slug untuk URL unik
            $table->text('description')->nullable(); // Deskripsi singkat album
            $table->string('cover_image')->nullable(); // Path gambar cover album
            $table->boolean('is_published')->default(false); // Status publikasi album
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

