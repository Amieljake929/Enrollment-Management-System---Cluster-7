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
    Schema::table('concerns', function (Blueprint $table) {
        // Idagdag ang concern_type kung wala pa sa table
        if (!Schema::hasColumn('concerns', 'concern_type')) {
            $table->string('concern_type')->after('email')->nullable();
        }
        // Idagdag ang remarks column para sa reply ni Admin
        $table->text('remarks')->after('concern')->nullable();
    });
}

public function down(): void
{
    Schema::table('concerns', function (Blueprint $table) {
        $table->dropColumn(['concern_type', 'remarks']);
    });
}
};
