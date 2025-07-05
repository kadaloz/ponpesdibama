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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Program (misal: Tahfidz Al-Qur'an, Studi Kitab Kuning)
            $table->string('slug')->unique(); // Slug untuk URL, unik
            $table->text('description')->nullable(); // Deskripsi lengkap program
            $table->string('duration')->nullable(); // Durasi program (misal: 3 Tahun, 6 Semester)
            $table->boolean('is_active')->default(true); // Status aktif/non-aktif program
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

