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
        DB::statement("ALTER TABLE shs_status MODIFY COLUMN info_status ENUM('Pending', 'Validated', 'Cancelled', 'Waiting', 'Re-Evaluation', 'Archived') NOT NULL DEFAULT 'Pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE shs_status MODIFY COLUMN info_status ENUM('Pending', 'Validated', 'Cancelled', 'Waiting', 'Re-Evaluation') NOT NULL DEFAULT 'Pending'");
    }
};
