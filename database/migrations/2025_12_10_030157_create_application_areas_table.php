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
        Schema::create('application_areas', function (Blueprint $table) {
            $table->bigInteger('job_area_id')->unsigned();
            $table->bigInteger('application_id')->unsigned();
            $table->string('status', 100)->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['job_area_id', 'application_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_application');
    }
};
