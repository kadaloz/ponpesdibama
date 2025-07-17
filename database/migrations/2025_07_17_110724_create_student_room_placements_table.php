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
        Schema::create('student_room_placements', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel students
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            // Foreign Key ke tabel rooms
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->date('start_date'); // Tanggal mulai menempati kamar
            $table->date('end_date')->nullable(); // Tanggal keluar dari kamar (null jika masih menempati)
            $table->boolean('is_active')->default(true); // Status penempatan (aktif/non-aktif)
            $table->timestamps();

            // Menambahkan constraint unik agar satu santri hanya bisa menempati satu kamar aktif pada satu waktu
            // Ini akan memerlukan penanganan khusus saat memindahkan santri (mengakhiri penempatan lama)
            $table->unique(['student_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_room_placements');
    }
};