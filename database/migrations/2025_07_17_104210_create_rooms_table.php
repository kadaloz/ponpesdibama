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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique(); // Nama/Nomor Kamar, harus unik
            $table->integer('capacity'); // Kapasitas maksimal santri
            $table->enum('gender_type', ['banin', 'banat'])->comment('Banin untuk laki-laki, Banat untuk perempuan'); // Jenis kelamin penghuni
            $table->enum('status', ['available', 'full', 'renovation', 'inactive'])->default('available'); // Status kamar
            $table->text('description')->nullable(); // Deskripsi atau fasilitas tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};