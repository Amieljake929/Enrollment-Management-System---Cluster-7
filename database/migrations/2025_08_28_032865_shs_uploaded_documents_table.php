<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_uploaded_documents', function (Blueprint $table) {
            $table->id('upload_id');
            $table->foreignId('student_id')->constrained('shs_students', 'student_id')->onDelete('cascade');
            $table->foreignId('doc_id')->constrained('shs_documents', 'doc_id');
            $table->string('file_path', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_uploaded_documents');
    }
};