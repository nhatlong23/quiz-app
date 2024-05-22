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
        Schema::create('result', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_id')->index();
            $table->unsignedBigInteger('exam_id')->index();
            $table->float('point');
            $table->boolean('status');
            $table->timestamps();

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
        Schema::dropIfExists('result');
    }
};
