<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('document_akta_path')->nullable();
            $table->string('document_kk_path')->nullable();
            $table->string('document_ijazah_path')->nullable();
            $table->string('document_photo_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['document_akta_path', 'document_kk_path', 'document_ijazah_path', 'document_photo_path']);
        });
    }
};

