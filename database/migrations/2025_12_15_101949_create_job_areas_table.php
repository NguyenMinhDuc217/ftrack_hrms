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
        Schema::create('job_areas', function (Blueprint $table) {
            $table->id('job_area_id');
            $table->bigInteger('job_id');
            $table->bigInteger('province_id');
            $table->bigInteger('ward_id')->nullable();
            $table->bigInteger('headcount')->nullable();
            $table->string('status', 50)->nullable()->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_areas');
    }
};
