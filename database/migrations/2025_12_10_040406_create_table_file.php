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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable(); // Unique identifier for external referencing
            $table->string('disk')->default('local')->comment('local, public, s3, etc.');
            $table->string('path'); // Relative path on the disk
            $table->string('name')->nullable(); // Original filename
            $table->string('extension', 10)->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->default(0); // Size in bytes
            $table->unsignedBigInteger('uploaded_by')->nullable(); // User ID who uploaded
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
