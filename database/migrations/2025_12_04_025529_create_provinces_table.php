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
        Schema::create('regions', function (Blueprint $table) {
            $table->integer('id')->primary(); // Corresponds to PRIMARY KEY (id)
            $table->string('name', 255);      // Corresponds to varchar(255) NOT NULL
            $table->string('name_en', 255);   // Corresponds to varchar(255) NOT NULL
            $table->string('code_name', 255)->nullable(); // Corresponds to varchar(255) NULL
            $table->string('code_name_en', 255)->nullable(); // Corresponds to varchar(255) NULL
        });

        Schema::create('units', function (Blueprint $table) {
            $table->integer('id')->primary(); // Corresponds to PRIMARY KEY (id)
            $table->string('full_name', 255)->nullable();
            $table->string('full_name_en', 255)->nullable();
            $table->string('short_name', 255)->nullable();
            $table->string('short_name_en', 255)->nullable();
            $table->string('code_name', 255)->nullable();
            $table->string('code_name_en', 255)->nullable();
        });

        Schema::create('provinces', function (Blueprint $table) {
            $table->id('id');
            $table->string('code', 20)->unique();
            $table->string('name', 255);
            $table->string('name_en', 255)->nullable();
            $table->string('full_name', 255);
            $table->string('full_name_en', 255)->nullable();
            $table->string('code_name', 255)->nullable();

            // Foreign Key and Index
            $table->integer('unit_id')->nullable();
            // Create the foreign key constraint
            $table->foreign('unit_id', 'provinces_unit_id_fkey')
                ->references('id')
                ->on('units');
            // Create the index
            $table->index('unit_id', 'idx_provinces_unit');
        });

        Schema::create('wards', function (Blueprint $table) {
            $table->id('id');
            $table->string('code', 20)->unique();
            $table->string('name', 255);
            $table->string('name_en', 255)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('full_name_en', 255)->nullable();
            $table->string('code_name', 255)->nullable();

            // Foreign Keys and Indexes
            $table->string('province_code', 20)->nullable();
            $table->integer('unit_id')->nullable();

            // Foreign Key to units
            $table->foreign('unit_id', 'wards_unit_id_fkey')
                ->references('id')
                ->on('units');

            // Foreign Key to provinces
            $table->foreign('province_code', 'wards_province_code_fkey')
                ->references('code')
                ->on('provinces');

            // Create indexes
            $table->index('province_code', 'idx_wards_province');
            $table->index('unit_id', 'idx_wards_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
        Schema::dropIfExists('units');
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('wards');
    }
};
