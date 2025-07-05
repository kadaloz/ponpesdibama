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
        Schema::create('halaqohs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama halaqoh (misal: Halaqoh Tahfidz Putra A)
            $table->text('description')->nullable(); // Deskripsi halaqoh
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null'); // Pengajar utama halaqoh
            $table->date('start_date')->nullable(); // Tanggal mulai halaqoh
            $table->date('end_date')->nullable(); // Tanggal selesai halaqoh (opsional)
            $table->enum('status', ['active', 'inactive', 'completed'])->default('active'); // Status halaqoh
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halaqohs');
    }
};

