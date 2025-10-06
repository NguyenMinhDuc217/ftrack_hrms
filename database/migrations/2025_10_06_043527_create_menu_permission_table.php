<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('guard_name')->default('web');
            $table->timestamps();
            $table->unique(['menu_id', 'permission_id'], 'menu_permission_unique');
            $table->index(['permission_id', 'guard_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_permission');
    }
};
