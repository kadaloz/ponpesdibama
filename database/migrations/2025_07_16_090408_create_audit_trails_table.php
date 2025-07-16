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
        Schema::create('audit_trails', function (Blueprint $table) {
    $table->id();
    $table->string('user_name')->nullable(); // atau user_id jika ada
    $table->string('action'); // contoh: 'create_santri', 'update_halaqoh'
    $table->text('description')->nullable();
    $table->ipAddress('ip_address')->nullable();
    $table->string('user_agent')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
};
