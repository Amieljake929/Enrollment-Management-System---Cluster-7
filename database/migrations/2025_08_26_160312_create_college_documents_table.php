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
    Schema::create('college_documents', function (Blueprint $table) {
        $table->id('doc_id');
        $table->string('document_name', 255);
        $table->foreignId('type_id')->constrained('college_student_types', 'type_id')->onDelete('cascade');
        $table->unique(['document_name', 'type_id'], 'unique_doc_per_type');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_documents');
    }
};
