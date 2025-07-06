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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->integer('vacancies')->default(1);
            $table->string('location');
            $table->string('role');
            $table->integer('min_ex')->nullable();
            $table->integer('max_ex')->nullable();
            $table->string('employment_type');
            $table->decimal('min_sal', 10, 2)->nullable();
            $table->decimal('max_sal', 10, 2)->nullable();
            $table->text('required_skills')->nullable();
            $table->text('semi_required_skills')->nullable();
            $table->text('description')->nullable();
            $table->enum('job_status', ['open', 'closed'])->default('open');
            $table->boolean('status')->default(1);
            $table->date('last_date_apply')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
