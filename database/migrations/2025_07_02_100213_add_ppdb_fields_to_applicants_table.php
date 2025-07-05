<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            if (!Schema::hasColumn('applicants', 'ppdb_type')) {
                $table->string('ppdb_type')->nullable()->after('chosen_program');
            }
            if (!Schema::hasColumn('applicants', 'halaqoh_period')) {
                $table->string('halaqoh_period')->nullable()->after('ppdb_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            // NOTE: SQLite doesn't support dropping columns directly.
            // If you're using MySQL or Postgres, you can uncomment:
            // $table->dropColumn(['ppdb_type', 'halaqoh_period']);
        });
    }
};

