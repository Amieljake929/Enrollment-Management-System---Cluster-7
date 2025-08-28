<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('course_name', 255);
            $table->foreignId('branch_id')->constrained('shs_branches', 'branch_id')->onDelete('cascade');
            $table->unique(['course_name', 'branch_id'], 'unique_course_per_branch');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_courses');
    }
};