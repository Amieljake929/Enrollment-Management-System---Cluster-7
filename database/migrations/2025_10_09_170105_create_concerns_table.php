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
        Schema::create('concerns', function (Blueprint $table) {
    $table->id();
    $table->string('student_type');
    $table->string('first_name');
    $table->string('middle_name')->nullable();
    $table->string('last_name');
    $table->string('email');
    $table->text('concern');

    // NEW: status column (default Pending)
    $table->enum('status', ['Pending', 'Assigned', 'Completed', 'Rejected'])
          ->default('Pending')
          ->index();

    $table->timestamp('submission_date')->useCurrent();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerns');
    }
};
