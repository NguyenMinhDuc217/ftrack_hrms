<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email')->unique();
            $table->string('username', 100);
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('province_ids', 255)->nullable();
            $table->string('phone_number', 11)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->default(Hash::make('password'));
            $table->string('avatar')->nullable();
            $table->bigInteger('height')->nullable();
            $table->string('gender', 100)->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->date('hire_date')->nullable(); // Ngày bắt đầu làm việc
            $table->bigInteger('manager_id')->nullable();
            $table->bigInteger('document_default_id')->nullable();
            $table->bigInteger('role_id')->default(3);
            $table->string('employment_type', 255)->nullable();
            $table->boolean('applicant')->default(0);
            $table->bigInteger('org_id')->default(0);
            $table->string('google_id', 100)->nullable();
            $table->string('login_type', 100)->default('system');
            $table->string('status', 100)->default('unverified');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
