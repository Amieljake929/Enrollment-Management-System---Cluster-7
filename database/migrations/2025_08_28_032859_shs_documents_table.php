<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shs_documents', function (Blueprint $table) {
            $table->id('doc_id');
            $table->string('document_name', 255);
            $table->foreignId('type_id')->constrained('shs_student_types', 'type_id')->onDelete('cascade');
            $table->unique(['document_name', 'type_id'], 'unique_doc_per_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shs_documents');
    }
};