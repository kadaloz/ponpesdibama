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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama barang, contoh: "Kasur Busa", "Lemari Buku"
            $table->text('description')->nullable(); // Deskripsi atau keterangan tambahan
            $table->string('serial_number')->unique()->nullable(); // Nomor seri barang (opsional, harus unik jika diisi)
            $table->enum('condition', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik'); // Kondisi fisik barang
            $table->date('acquisition_date')->nullable(); // Tanggal perolehan/pembelian barang
            $table->enum('status', ['Tersedia', 'Dipinjam', 'Rusak', 'Hilang'])->default('Tersedia'); // Status ketersediaan barang

            // Kunci asing (Foreign Keys) untuk relasi:
            // Menghubungkan item ke sebuah kamar (Room)
            $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('set null');
            // Menghubungkan item ke santri yang meminjam/menggunakan (opsional)
            $table->foreignId('assigned_to_student_id')->nullable()->constrained('students')->onDelete('set null');

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};