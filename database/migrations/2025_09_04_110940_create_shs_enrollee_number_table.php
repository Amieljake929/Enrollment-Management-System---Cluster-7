<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shs_enrollee_number', function (Blueprint $table) {
            $table->id();
            $table->string('enrollee_no', 12)->unique(); // e.g., rB5uH8kW2xJ4
            $table->foreignId('student_id')->constrained('shs_students', 'student_id')->onDelete('cascade');
            $table->timestamps();

            $table->index('enrollee_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shs_enrollee_number');
    }
};