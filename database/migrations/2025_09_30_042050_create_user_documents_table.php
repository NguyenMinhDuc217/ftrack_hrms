<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    use SoftDeletes;

    public function up(): void
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id('document_id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('uploaded_by')->nullable();
            $table->string('document_type', 255)->nullable();
            $table->string('document_title', 255)->nullable();
            $table->boolean('confidential')->default(0);
            $table->string('file_url', 255)->nullable();
            $table->bigInteger('file_name_original')->nullable();
            $table->string('status',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_documents');
    }
};
