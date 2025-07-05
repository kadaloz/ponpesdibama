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
        Schema::create('halaqoh_schedule_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('halaqoh_id')->constrained()->onDelete('cascade');
    $table->foreignId('schedule_id')->nullable()->constrained('halaqoh_schedules')->onDelete('set null');
    $table->enum('action', ['created', 'updated', 'deleted']);
    $table->json('data_before')->nullable(); // hanya untuk updated & deleted
    $table->json('data_after')->nullable();  // untuk created & updated
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halaqoh_schedule_logs');
    }
};
