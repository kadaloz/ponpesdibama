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
        Schema::table('applicants', function (Blueprint $table) {
            // Menambahkan kolom 'halaqoh_period' setelah 'ppdb_type'
            $table->enum('halaqoh_period', ['Sore', 'Malam'])->nullable()->after('ppdb_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('halaqoh_period');
        });
    }
};
