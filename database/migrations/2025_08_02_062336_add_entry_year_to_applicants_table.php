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
            // Menambahkan kolom entry_year dengan tipe data integer, bisa bernilai null
            $table->year('entry_year')->nullable()->after('ppdb_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Menghapus kolom entry_year saat rollback
            $table->dropColumn('entry_year');
        });
    }
};

