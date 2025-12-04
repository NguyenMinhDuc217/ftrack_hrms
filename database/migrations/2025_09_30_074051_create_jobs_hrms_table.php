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
        Schema::create('jobs_hrms', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('location')->nullable();
            $table->string('employment_type', 255)->nullable();
            $table->bigInteger('headcount')->nullable();
            $table->mediumText('description_md')->nullable();
            $table->mediumText('requirements_md')->nullable();
            $table->decimal('min_salary', 12, 2)->nullable();
            $table->decimal('max_salary', 12, 2)->nullable();
            $table->string('currency')->nullable()->comment('Tiền tệ');
            $table->bigInteger('org_id')->default(0);
            $table->string('status',50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
