<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->text('user_agent');
            $table->timestamp('last_activity')->nullable();
            $table->unsignedBigInteger('students_id')->index();

            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};
