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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_code');
            $table->string('name');
            $table->string('gender');
            $table->date('birth');
            $table->unsignedBigInteger('class_id')->index();
            $table->string('school_year');
            $table->text('images')->nullable();
            $table->string('password');
            $table->string('cccd');
            $table->string('phone');
            $table->string('email');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
