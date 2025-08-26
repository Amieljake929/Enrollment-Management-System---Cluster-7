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
    Schema::create('college_students', function (Blueprint $table) {
        $table->id('student_id');
        $table->foreignId('type_id')->nullable()->constrained('college_student_types', 'type_id')->onDelete('set null');
        $table->string('first_name', 100);
        $table->string('middle_name', 100);
        $table->string('last_name', 100);
        $table->string('extension_name', 20)->nullable();
        $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated', 'Divorced']);
        $table->enum('gender', ['Male', 'Female']);
        $table->date('dob');
        $table->text('place_of_birth');
        $table->string('nationality', 50);
        $table->char('previous_student_id', 8)->unique()->nullable();
        $table->string('contact_number', 15);
        $table->string('email', 100)->unique();
        $table->string('social_media', 150);
        $table->string('religion', 50);
        $table->text('current_address');
        $table->string('city_municipality', 100);
        $table->string('province', 100);
        $table->string('zip_code', 10);
        $table->foreignId('region_id')->nullable()->constrained('college_regions', 'region_id')->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_students');
    }
};
