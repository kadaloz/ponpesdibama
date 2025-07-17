<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('gender_temp', 20)->nullable()->after('gender');
        });

        DB::statement("UPDATE students SET gender_temp = CASE
            WHEN gender = 'banin' THEN 'laki-laki'
            WHEN gender = 'banat' THEN 'perempuan'
            ELSE NULL
        END;");

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->enum('gender', ['laki-laki', 'perempuan'])->after('name');
        });

        DB::statement("UPDATE students SET gender = gender_temp;");

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gender_temp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('gender_temp', 20)->nullable()->after('gender');
        });

        DB::statement("UPDATE students SET gender_temp = CASE
            WHEN gender = 'laki-laki' THEN 'banin'
            WHEN gender = 'perempuan' THEN 'banat'
            ELSE NULL
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