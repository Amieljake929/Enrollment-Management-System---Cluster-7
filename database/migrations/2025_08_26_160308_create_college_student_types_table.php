<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // /database/migrations/xxxx_create_college_student_types_table.php
public function up()
{
    Schema::create('college_student_types', function (Blueprint $table) {
        $table->id('type_id');
        $table->string('type_name', 50)->unique();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('college_student_types');
}
};
