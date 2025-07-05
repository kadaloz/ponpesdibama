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
            // Tambahkan kolom-kolom ini setelah 'name' atau 'gender' sesuai kebutuhan urutan Anda
            $table->string('nisn')->nullable()->after('date_of_birth');
            $table->string('last_education')->nullable()->after('nisn');
            $table->string('school_origin')->nullable()->after('last_education');

            // Tambahkan kolom untuk detail orang tua/wali dan alamat
            $table->string('parent_email')->nullable()->after('parent_phone');
            $table->string('parent_occupation')->nullable()->after('parent_email');
            $table->string('city')->nullable()->after('address');
            $table->string('province')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'nisn',
                'last_education',
                'school_origin',
                'parent_email',
                'parent_occupation',
                'city',
                'province',
            ]);
        });
    }
};

