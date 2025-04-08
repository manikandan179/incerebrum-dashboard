<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->unique();
            $table->dateTime('dob', 3)->nullable();
            $table->string('nationality', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('highest_qualification', 191)->nullable();
            $table->string('institution_name', 191)->nullable();
            $table->string('course_name', 191)->nullable();
            $table->integer('year_of_completion')->nullable();
            $table->string('certificates', 191)->nullable();
            $table->dateTime('preferred_start_date', 3)->nullable();
            $table->string('specializations', 191)->nullable();
            $table->string('work_experience', 191)->nullable();
            $table->string('reason_for_joining', 191)->nullable();
            $table->string('special_fequirements', 191)->nullable();
            $table->timestamps(3); // created_at and updated_at with microseconds
            $table->softDeletes('deleted_at', 3); // soft delete column

            // Foreign key linking to user table
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate');
    }
};
