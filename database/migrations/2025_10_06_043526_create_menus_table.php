<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            // Hiển thị
            $table->string('label');                // Tên hiển thị
            $table->string('slug')->unique();      //(dashboard, users, jobs)

            // Điều hướng
            $table->enum('type', ['route', 'url', 'header', 'divider'])->default('route'); // route: dùng route_name, url: dùng url, header/divider: chỉ để nhóm/ngăn cách
            $table->string('route_name')->nullable();
            $table->string('url')->nullable();

            // Trang trí
            $table->string('icon')->nullable();     // lớp icon (ti ti-*, fa-*)
            $table->string('badge')->nullable();    // text badge nhỏ (tuỳ chọn)

            // Cấu trúc cây
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('menus')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->unsignedInteger('position')->default(0);  // Thứ tự trong cùng parent

            // Kiểm soát hiển thị
            $table->boolean('is_active')->default(true);
            $table->string('guard_name')->default('web');

            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users', 'user_id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users', 'user_id')->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();

            // Index phục vụ truy vấn nhanh
            $table->index(['parent_id', 'position']);
            $table->index(['type', 'is_active']);
            $table->index(['route_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
