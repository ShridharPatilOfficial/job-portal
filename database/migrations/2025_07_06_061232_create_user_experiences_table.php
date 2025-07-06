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
        Schema::create('user_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('current_company')->nullable();
            $table->string('company_name');
            $table->string('industry')->nullable();
            $table->string('job_role');
            $table->string('job_type')->nullable();
            $table->string('employment_type')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('skills_used')->nullable();
            $table->text('job_profile')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_experiences');
    }
};
