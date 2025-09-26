<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_enrollment_preferences', function (Blueprint $table) {
            $table->id('preference_id');
            $table->foreignId('student_id')->unique()->constrained('shs_students', 'student_id')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('shs_branches', 'branch_id');
            $table->foreignId('course_id')->constrained('shs_courses', 'course_id');
            $table->foreignId('level_id')->constrained('shs_year_levels', 'level_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_enrollment_preferences');
    }
};