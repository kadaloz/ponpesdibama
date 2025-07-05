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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique()->nullable(); // Nomor Pendaftaran Otomatis
            $table->string('full_name'); // Nama Lengkap Calon Santri
            $table->string('gender')->nullable(); // Jenis Kelamin (L/P)
            $table->string('place_of_birth')->nullable(); // Tempat Lahir
            $table->date('date_of_birth')->nullable(); // Tanggal Lahir
            $table->string('nisn')->nullable(); // NISN (Nomor Induk Siswa Nasional)
            $table->string('last_education')->nullable(); // Pendidikan Terakhir
            $table->string('school_origin')->nullable(); // Asal Sekolah

            // Data Orang Tua/Wali
            $table->string('parent_name'); // Nama Ayah/Wali
            $table->string('parent_phone'); // Nomor HP Orang Tua/Wali
            $table->string('parent_email')->nullable(); // Email Orang Tua/Wali
            $table->string('parent_occupation')->nullable(); // Pekerjaan Orang Tua

            // Alamat
            $table->string('address'); // Alamat Lengkap
            $table->string('city')->nullable(); // Kota
            $table->string('province')->nullable(); // Provinsi

            // Pilihan Program (bisa disesuaikan jika ingin lebih dari 1 pilihan)
            $table->string('chosen_program')->nullable(); // Program yang dipilih (misal: Tahfidz, Kitab Kuning)

            // Dokumen (path ke file yang diunggah)
            $table->string('document_akta_path')->nullable(); // Path Akta Kelahiran
            $table->string('document_kk_path')->nullable(); // Path Kartu Keluarga
            $table->string('document_ijazah_path')->nullable(); // Path Ijazah Terakhir
            $table->string('document_photo_path')->nullable(); // Path Pas Foto

            // Status Pendaftaran
            // Contoh: pending, submitted, verified, accepted, rejected, re-registered
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable(); // Catatan dari admin

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};

