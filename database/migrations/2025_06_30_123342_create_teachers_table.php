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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique()->nullable(); // Nomor Induk Pengajar (Opsional)
            $table->string('full_name'); // Nama Lengkap Pengajar
            $table->string('gender')->nullable(); // Jenis Kelamin
            $table->string('place_of_birth')->nullable(); // Tempat Lahir
            $table->date('date_of_birth')->nullable(); // Tanggal Lahir
            $table->string('phone_number')->nullable(); // Nomor Telepon/HP
            $table->string('specialization')->nullable(); // Bidang Spesialisasi (misal: Fiqih, Bahasa Arab)
            $table->date('join_date')->nullable(); // Tanggal Bergabung
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status pengajar

            // Relasi one-to-one dengan tabel users (opsional, jika setiap pengajar punya akun login)
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};

