<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_parent_info', function (Blueprint $table) {
            $table->id('parent_id');
            $table->foreignId('student_id')->unique()->constrained('shs_students', 'student_id')->onDelete('cascade');

            // Mother
            $table->string('mother_first_name', 100);
            $table->string('mother_middle_name', 100);
            $table->string('mother_last_name', 100);
            $table->string('mother_occupation', 100);
            $table->string('mother_contact', 20);
            $table->string('mother_email', 100);

            // Father
            $table->string('father_first_name', 100);
            $table->string('father_middle_name', 100);
            $table->string('father_last_name', 100);
            $table->string('father_occupation', 100);
            $table->string('father_contact', 20);
            $table->string('father_email', 100);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_parent_info');
    }
};