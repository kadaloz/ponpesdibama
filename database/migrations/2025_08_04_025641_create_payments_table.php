<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete(); // Relasi ke santri
            $table->string('category'); // contoh: SPP, Daftar Ulang, Kitab
            $table->string('month')->nullable(); // Untuk pembayaran bulanan
            $table->date('paid_at'); // tanggal dibayar
            $table->decimal('amount', 12, 2); // nominal
            $table->string('method')->nullable(); // Tunai, Transfer, QRIS
            $table->text('note')->nullable(); // catatan tambahan
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
