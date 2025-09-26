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
    Schema::create('college_parents_info', function (Blueprint $table) {
        $table->id('parent_id');
        $table->foreignId('student_id')->constrained('college_students', 'student_id')->onDelete('cascade');
        $table->enum('parent_type', ['Mother', 'Father']);
        $table->string('first_name', 100);
        $table->string('middle_name', 100);
        $table->string('last_name', 100);
        $table->string('occupation', 100);
        $table->string('contact_number', 15);
        $table->string('email', 100);
        $table->unique(['student_id', 'parent_type'], 'unique_parent_per_student');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_parents_info');
    }
};
