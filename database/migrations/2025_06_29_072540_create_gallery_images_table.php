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
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel 'galleries'
            $table->foreignId('gallery_id')->constrained('galleries')->onDelete('cascade');
            $table->string('image_path'); // Path gambar
            $table->string('caption')->nullable(); // Keterangan gambar
            $table->integer('order')->default(0); // Urutan gambar dalam album
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};

