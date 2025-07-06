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
        Schema::create('users', function (Blueprint $table) {
            $table->id();        
             $table->string('profile')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('password');
            $table->integer('role'); //['seeker' --> 2 , 'recruiter' --> 1, 'admin' --> 0]
            $table->boolean('status')->default(0); //['active'--> 1, 'inactive' --> 0]
            $table->string('marital_status', )->nullable();  //['single', 'married','widow']
            $table->date('dob')->nullable();
            $table->string('religion')->nullable();
            $table->text('address')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('languages')->nullable();
            $table->string('api_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
