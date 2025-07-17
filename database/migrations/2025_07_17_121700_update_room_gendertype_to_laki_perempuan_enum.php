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
        Schema::table('rooms', function (Blueprint $table) {
            // Tambahkan kolom temporary untuk menyimpan data sementara
            // Ini diperlukan karena mengubah ENUM langsung seringkali bermasalah di MySQL
            $table->string('gender_type_temp', 20)->nullable()->after('gender_type');
        });

        // Pindahkan dan konversi data dari 'banin'/'banat' ke 'laki-laki'/'perempuan'
        // Jika ada nilai yang tidak 'banin' atau 'banat', akan diubah menjadi NULL
        DB::statement("UPDATE rooms SET gender_type_temp = CASE
            WHEN gender_type = 'banin' THEN 'laki-laki'
            WHEN gender_type = 'banat' THEN 'perempuan'
            ELSE NULL
        END;");

        // Hapus kolom lama
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('gender_type');
        });

        // Tambahkan kolom baru dengan definisi ENUM yang benar ('laki-laki', 'perempuan')
        Schema::table('rooms', function (Blueprint $table) {
            $table->enum('gender_type', ['laki-laki', 'perempuan'])
                  ->comment('laki-laki untuk laki-laki, perempuan untuk perempuan')
                  ->after('capacity'); // Posisikan kembali setelah 'capacity'
        });

        // Pindahkan data kembali dari kolom temporary ke kolom baru
        DB::statement("UPDATE rooms SET gender_type = gender_type_temp;");

        // Hapus kolom temporary
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('gender_type_temp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Logika untuk mengembalikan perubahan (jika Anda rollback)
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('gender_type_temp', 20)->nullable()->after('gender_type');
        });

        DB::statement("UPDATE rooms SET gender_type_temp = CASE
            WHEN gender_type = 'laki-laki' THEN 'banin'
            WHEN gender_type = 'perempuan' THEN 'banat'
            ELSE NULL
        END;");

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('gender_type');
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->enum('gender_type', ['banin', 'banat'])
                  ->comment('Banin untuk laki-laki, Banat untuk perempuan')
                  ->after('capacity');
        });

        DB::statement("UPDATE rooms SET gender_type = gender_type_temp;");

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('gender_type_temp');
        });
    }
};