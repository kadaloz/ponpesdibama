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
        Schema::table('students', function (Blueprint $table) {
            // Tambahkan kolom 'district' setelah 'city'
            $table->string('district')->nullable()->after('city');
            // Tambahkan kolom 'village' setelah 'district'
            $table->string('village')->nullable()->after('district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Hapus kolom saat rollback
            $table->dropColumn('village');
            $table->dropColumn('district');
        });
    }
};