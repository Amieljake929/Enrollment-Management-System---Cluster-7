<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_students', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('type_id')->constrained('shs_student_types', 'type_id');
            $table->string('first_name', 100);
            $table->string('middle_name', 100);
            $table->string('last_name', 100);
            $table->string('extension_name', 10)->nullable();
            $table->string('civil_status', 20);
            $table->string('gender', 10);
            $table->date('dob');
            $table->string('place_of_birth', 255);
            $table->string('nationality', 50);
            $table->string('lrn', 12)->unique(); // LRN is 12 digits
            $table->string('previous_student_id', 8)->nullable(); // Only for Returnee
            $table->string('current_address', 255);
            $table->string('city_municipality', 100);
            $table->string('province', 100);
            $table->foreignId('region_id')->nullable()->constrained('college_regions', 'region_id')->onDelete('set null');
            $table->string('zip_code', 10);
            $table->string('religion', 50);
            $table->string('email', 100)->unique();
            $table->string('contact_number', 20);
            $table->string('social_media', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_students');
    }
};