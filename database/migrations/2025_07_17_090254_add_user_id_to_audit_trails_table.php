<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_trails', function (Blueprint $table) {
            // Tambahkan kolom user_id
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('description');

            // Opsional: Rename kolom 'user' ke 'user_name_legacy' jika Anda ingin mempertahankannya sementara
            // atau drop saja jika Anda yakin tidak memerlukannya lagi
            // $table->renameColumn('user', 'user_name_legacy');
        });
    }

    public function down(): void
    {
        Schema::table('audit_trails', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            // $table->renameColumn('user_name_legacy', 'user'); // Jika direname di up
        });
    }
};