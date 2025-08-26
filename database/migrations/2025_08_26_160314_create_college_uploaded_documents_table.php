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
    Schema::create('college_uploaded_documents', function (Blueprint $table) {
        $table->id('upload_id');
        $table->foreignId('student_id')->constrained('college_students', 'student_id')->onDelete('cascade');
        $table->foreignId('doc_id')->constrained('college_documents', 'doc_id');
        $table->string('file_path', 500);
        $table->enum('file_type', ['pdf', 'jpg', 'jpeg', 'png']);
        $table->timestamp('uploaded_at')->useCurrent();
        $table->unique(['student_id', 'doc_id'], 'unique_doc_upload');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_uploaded_documents');
    }
};
