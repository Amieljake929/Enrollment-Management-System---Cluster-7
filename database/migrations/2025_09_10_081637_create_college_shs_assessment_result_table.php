<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('college_shs_assessment_result', function (Blueprint $table) {
            $table->id();
            $table->string('assessment_id')->unique(); // AT0001, AT0002, etc.
            $table->string('full_name');
            $table->integer('age');
            $table->string('email');

            // ✅ DAGDAGAN MO LANG DITO ANG MGA BAGONG COLUMN
            $table->string('recommended_course')->nullable();
            $table->string('recommended_course_description')->nullable();
            $table->decimal('confidence_score', 5, 2)->nullable();
            $table->text('narrative')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('college_shs_assessment_result');
    }
};