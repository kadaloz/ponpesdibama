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
        Schema::table('halaqohs', function (Blueprint $table) {
            // Menambahkan kolom 'student_limit' setelah kolom 'status'
            $table->integer('student_limit')->nullable()->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('halaqohs', function (Blueprint $table) {
            $table->dropColumn('student_limit');
        });
    }
};

