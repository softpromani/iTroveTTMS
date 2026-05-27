<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('faculties', function (Blueprint $table) {
            if (!Schema::hasColumn('faculties', 'employee_code')) {
                $table->string('employee_code')->unique()->after('user_id');
            }
            if (!Schema::hasColumn('faculties', 'designation')) {
                $table->string('designation')->nullable()->after('qualification');
            }
            if (!Schema::hasColumn('faculties', 'max_teaching_hours_per_week')) {
                $table->unsignedInteger('max_teaching_hours_per_week')->default(0)->after('expertise');
            }
            if (!Schema::hasColumn('faculties', 'availability')) {
                $table->json('availability')->nullable()->after('max_teaching_hours_per_week');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed – columns are managed by earlier migration.
    }
};
