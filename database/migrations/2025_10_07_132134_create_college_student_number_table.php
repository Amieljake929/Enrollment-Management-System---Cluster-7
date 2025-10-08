<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('college_student_number', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('student_id_number')->nullable()->unique();
            $table->timestamps();

            // Correct foreign key
            $table->foreign('student_id')
                  ->references('student_id')
                  ->on('college_students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('college_student_number');
    }
};
