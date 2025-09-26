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
    Schema::create('college_enrollment_preferences', function (Blueprint $table) {
        $table->id('preference_id');
        $table->foreignId('student_id')->unique()->constrained('college_students', 'student_id')->onDelete('cascade');
        $table->foreignId('branch_id')->constrained('college_branches', 'branch_id');
        $table->foreignId('course_id')->constrained('college_courses', 'course_id');
        $table->foreignId('level_id')->constrained('college_year_levels', 'level_id');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_enrollment_preferences');
    }
};
