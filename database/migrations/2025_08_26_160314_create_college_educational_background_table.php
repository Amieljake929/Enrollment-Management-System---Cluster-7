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
    Schema::create('college_educational_background', function (Blueprint $table) {
        $table->id('background_id');
        $table->foreignId('student_id')->unique()->constrained('college_students', 'student_id')->onDelete('cascade');
        $table->string('primary_school', 255);
        $table->year('primary_year_graduated');
        $table->string('secondary_school', 255);
        $table->year('secondary_year_graduated');
        $table->string('last_school_attended', 255);
        $table->year('last_school_year_graduated');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_educational_background');
    }
};
