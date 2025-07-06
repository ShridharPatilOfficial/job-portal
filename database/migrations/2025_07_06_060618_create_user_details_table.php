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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pref_location')->nullable();
            $table->string('pref_role')->nullable();
            $table->string('pref_sal_pack')->nullable();
            $table->string('job_type')->nullable();
            $table->string('emp_type')->nullable();
            $table->integer('total_experience')->nullable();
            $table->string('available_join')->nullable();
            $table->text('profile_summary')->nullable();
            $table->text('skills')->nullable();
            $table->string('resume');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
