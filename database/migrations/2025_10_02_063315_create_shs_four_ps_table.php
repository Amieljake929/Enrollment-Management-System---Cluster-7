<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_four_ps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('student_id')
                  ->on('shs_students')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_four_ps');
    }
};