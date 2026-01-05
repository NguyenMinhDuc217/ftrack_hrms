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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id('org_id');
            $table->string('name', 255);
            $table->bigInteger('image_id')->nullable();
            $table->string('slug', 255)->nullable()->unique('slug');
            $table->longText('description')->nullable();
            $table->string('link', 255)->nullable(); // Website
            $table->string('business_field', 255)->nullable();
            $table->string('phone_number', 11)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('address', 255)->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
