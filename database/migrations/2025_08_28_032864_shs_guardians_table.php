<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_guardians', function (Blueprint $table) {
            $table->id('guardian_id');
            $table->foreignId('student_id')->unique()->constrained('shs_students', 'student_id')->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('middle_name', 100);
            $table->string('last_name', 100);
            $table->date('dob')->nullable();
            $table->string('contact_number', 20);
            $table->string('email', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_guardians');
    }
};