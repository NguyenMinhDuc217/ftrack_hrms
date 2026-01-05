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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('file_url', 255)->nullable();
            $table->string('file_name_original')->nullable();
            $table->bigInteger('size')->nullable();
            $table->string('extension')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('uploaded_by')->nullable();
            $table->string('status', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
