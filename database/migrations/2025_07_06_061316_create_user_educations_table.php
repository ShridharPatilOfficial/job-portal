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
        Schema::create('user_educations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_detail_id')->nullable();
            $table->string('degree');
            $table->string('institute_name');
            $table->string('specialization')->nullable();
            $table->string('course_type')->nullable();
            $table->string('start_month')->nullable();
            $table->year('start_year')->nullable();
            $table->string('end_month')->nullable();
            $table->year('end_year')->nullable();
            $table->string('grade_cgpa')->nullable();
            $table->string('grade_per')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_detail_id')->references('id')->on('user_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_educations');
    }
};
