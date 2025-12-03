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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id('blog_id');
            $table->string('title', 255)->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 255)->nullable(); // Lưu json slug cho bài viết
            $table->bigInteger('user_id'); // Author
            $table->bigInteger('category_id')->default(0);
            $table->longText('image')->nullable();
            $table->bigInteger('view_count')->default(0);
            $table->string('status',50)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
