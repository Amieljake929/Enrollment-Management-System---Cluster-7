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
        Schema::create('archive_logs', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name');
            $table->string('student_name');
            $table->unsignedBigInteger('record_id');
            $table->enum('action', ['Archive', 'Restore']);
            $table->enum('category', ['College', 'SHS']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_logs');
    }
};
