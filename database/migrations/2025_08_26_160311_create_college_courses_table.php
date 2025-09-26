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
    Schema::create('college_courses', function (Blueprint $table) {
        $table->id('course_id');
        $table->string('course_name', 255);
        $table->foreignId('branch_id')->constrained('college_branches', 'branch_id')->onDelete('cascade');
        $table->unique(['course_name', 'branch_id'], 'unique_course_per_branch');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_courses');
    }
};
