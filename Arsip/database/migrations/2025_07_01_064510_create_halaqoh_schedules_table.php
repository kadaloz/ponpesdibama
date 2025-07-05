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
        Schema::create('halaqoh_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('halaqoh_id')->constrained('halaqohs')->onDelete('cascade');
            $table->string('day_of_week'); // Hari (e.g., Senin, Selasa)
            $table->time('start_time'); // Waktu mulai
            $table->time('end_time'); // Waktu selesai
            $table->string('location')->nullable(); // Lokasi (e.g., Masjid Utama, Ruang Kelas 3)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halaqoh_schedules');
    }
};

