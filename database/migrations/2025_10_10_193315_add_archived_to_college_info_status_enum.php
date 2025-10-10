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
        DB::statement("ALTER TABLE college_status MODIFY COLUMN info_status ENUM('Pending', 'Validated', 'Cancelled', 'Waiting', 'Re-Evaluate', 'Archived') NOT NULL DEFAULT 'Pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE college_status MODIFY COLUMN info_status ENUM('Pending', 'Validated', 'Cancelled', 'Waiting', 'Re-Evaluate') NOT NULL DEFAULT 'Pending'");
    }
};
