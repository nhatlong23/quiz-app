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
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->text('audio')->nullable();
            $table->string('max_questions');
            $table->string('password');
            $table->datetime('opening_time');
            $table->datetime('closing_time');
            $table->time('duration');
            $table->unsignedBigInteger('subjects_id')->index();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};
