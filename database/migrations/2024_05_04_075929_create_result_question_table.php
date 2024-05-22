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
        Schema::create('result_question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->index();
            $table->unsignedBigInteger('students_id')->index();
            $table->unsignedBigInteger('exam_id')->index();
            $table->string('selected_option');
            $table->boolean('is_correct');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')
                ->onDelete('cascade');
            $table->foreign('students_id')->references('id')->on('students')
                ->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exam')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_question');
    }
};
