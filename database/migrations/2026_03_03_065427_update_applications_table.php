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
         Schema::table('applications', function (Blueprint $table) {
            $table->decimal('current_salary', 12, 0)->nullable()->after('applied_at');
            $table->decimal('expected_salary', 12, 0)->nullable()->after('current_salary');
            $table->dateTime('expected_start_date')->nullable()->after('expected_salary');
            $table->integer('work_experience')->nullable()->after('expected_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('current_salary');
            $table->dropColumn('expected_salary');
            $table->dropColumn('expected_start_date');
            $table->dropColumn('work_experience');
        });
    }
};
