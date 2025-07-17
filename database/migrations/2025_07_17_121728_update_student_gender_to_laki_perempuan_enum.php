<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom gender_temp
        Schema::table('students', function (Blueprint $table) {
            $table->string('gender_temp', 20)->nullable()->after('gender');
        });

        // 2. Konversi gender lama ke gender_temp
        DB::statement("UPDATE students SET gender_temp = CASE
            WHEN gender = 'banin' THEN 'laki-laki'
            WHEN gender = 'banat' THEN 'perempuan'
            ELSE 'laki-laki'  -- Default aman jika NULL
        END;");

        // 3. Drop kolom gender lama
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        // 4. Buat kolom gender baru dengan enum
        Schema::table('students', function (Blueprint $table) {
            $table->enum('gender', ['laki-laki', 'perempuan'])->after('name');
        });

        // 5. Update gender baru dari gender_temp (dijamin tidak NULL)
        DB::statement("UPDATE students SET gender = gender_temp;");

        // 6. Drop kolom gender_temp
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gender_temp');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('gender_temp', 20)->nullable()->after('gender');
        });

        DB::statement("UPDATE students SET gender_temp = CASE
            WHEN gender = 'laki-laki' THEN 'banin'
            WHEN gender = 'perempuan' THEN 'banat'
            ELSE 'banin'  -- Default fallback
        END;");

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->enum('gender', ['banin', 'banat'])->after('name');
        });

        DB::statement("UPDATE students SET gender = gender_temp;");

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gender_temp');
        });
    }
};
