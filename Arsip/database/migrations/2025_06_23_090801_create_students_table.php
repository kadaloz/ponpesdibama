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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique()->nullable(); // Nomor Induk Santri (opsional, bisa digenerate)
            $table->string('name'); // Nama Lengkap Santri
            $table->string('gender')->nullable(); // Jenis Kelamin (L/P)
            $table->date('date_of_birth')->nullable(); // Tanggal Lahir
            $table->string('place_of_birth')->nullable(); // Tempat Lahir
            $table->string('address')->nullable(); // Alamat Lengkap
            $table->string('parent_name')->nullable(); // Nama Orang Tua/Wali
            $table->string('parent_phone')->nullable(); // Nomor Telepon Orang Tua/Wali
            $table->string('admission_year')->nullable(); // Tahun Masuk
            $table->string('status')->default('aktif'); // Status (aktif, non-aktif, lulus)
            $table->string('category')->nullable(); // Kategori Santri (misal: Tahfidz, Kitab Kuning, Umum)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

