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
    if (!Schema::hasColumn('applicants', 'ppdb_type')) {
        $table->string('ppdb_type')->nullable();
    }

    if (!Schema::hasColumn('applicants', 'halaqoh_period')) {
        $table->string('halaqoh_period')->nullable();
    }
});
}

public function down(): void
{
    Schema::table('applicants', function (Blueprint $table) {
        $table->dropColumn(['ppdb_type', 'halaqoh_period']);
    });
}

};
