<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shs_status', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('student_id');
    $table->enum('info_status', ['Pending', 'Validated', 'Cancelled', 'Enrolled', 'Re-Evaluate'])->default('Pending');
    $table->enum('payment', ['Not Paid', 'Paid'])->default('Not Paid');
    $table->text('remarks')->nullable();
    $table->timestamps();

    $table->foreign('student_id')
          ->references('student_id')   // <-- dapat student_id, hindi id
          ->on('shs_students')
          ->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('shs_status');
    }
};
