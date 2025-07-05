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
        Schema::create('halaqoh_student', function (Blueprint $table) {
            $table->foreignId('halaqoh_id')->constrained('halaqohs')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->date('join_date')->nullable(); // Tanggal santri bergabung dengan halaqoh
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status santri di halaqoh
            $table->timestamps();

            $table->primary(['halaqoh_id', 'student_id']); // Primary key gabungan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halaqoh_student');
    }
};


