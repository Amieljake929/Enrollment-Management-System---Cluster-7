<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_college_health_info_table.php
public function up()
{
    Schema::create('college_health_info', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id');
        $table->string('condition')->nullable(); // for "Others" text
        $table->enum('condition_type', [
            'Asthma', 'Allergies', 'Heart Disease', 'Hypertension',
            'Diabeties Type 2', 'Kidney Disease', 'Pneumonia', 'Tuberculosis',
            'Bleeding Disorders', 'Psychiatric Disorder', 'Cancer', 'Others'
        ])->nullable();
        $table->decimal('weight_kg', 5, 2)->nullable();
        $table->decimal('height_cm', 5, 2)->nullable();
        $table->timestamps();

        $table->foreign('student_id')
              ->references('student_id')
              ->on('college_students')
              ->onDelete('cascade');
    });
}
};
