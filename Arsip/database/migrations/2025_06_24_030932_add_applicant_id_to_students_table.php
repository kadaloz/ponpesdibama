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
        $table->foreignId('applicant_id')->nullable()->unique()->after('id')->constrained('applicants')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('students', function (Blueprint $table) {
        $table->dropForeign(['applicant_id']);
        $table->dropColumn('applicant_id');
    });
}
};
