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
        Schema::create('cv_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('full_name', 128)->nullable();
            $table->string('phone_number', 16)->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('province_code')->nullable();
            $table->string('province_name', 255)->nullable();
            $table->string('province_name_en', 255)->nullable();
            $table->string('title')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });

        Schema::create('cv_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_profile_id')->constrained('cv_profiles')->onDelete('cascade');
            $table->string('school', 255);
            $table->string('degree', 64);
            $table->string('major', 255);
            $table->boolean('is_studying')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('cv_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_profile_id')->constrained('cv_profiles')->onDelete('cascade');
            $table->string('company_name', 255);
            $table->string('position', 64);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('cv_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_profile_id')->constrained('cv_profiles')->onDelete('cascade');
            $table->string('name', 64);
            $table->string('group', 64)->nullable();
            $table->integer('year_of_experience')->nullable();
            $table->timestamps();
        });

        Schema::create('cv_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_profile_id')->constrained('cv_profiles')->onDelete('cascade');
            $table->string('language', 64);
            $table->string('level')->nullable(); // e.g., Native, Fluent, Intermediate
            $table->timestamps();
        });

        Schema::create('cv_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_profile_id')->constrained('cv_profiles')->onDelete('cascade');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('url', 1000)->nullable();
            $table->timestamps();
        });

        Schema::create('cv_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_profile_id')->constrained('cv_profiles')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('organization', 255);
            $table->date('issue_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('url', 1000)->nullable();
            $table->timestamps();
        });

        Schema::create('cv_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_profile_id')->constrained('cv_profiles')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('organization', 255);
            $table->year('year')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_awards');
        Schema::dropIfExists('cv_certificates');
        Schema::dropIfExists('cv_projects');
        Schema::dropIfExists('cv_languages');
        Schema::dropIfExists('cv_skills');
        Schema::dropIfExists('cv_experiences');
        Schema::dropIfExists('cv_education');
        Schema::dropIfExists('cv_profiles');
    }
};
