<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shs_students', function (Blueprint $table) {
            $table->foreignId('indigenous_id')->nullable()->after('region_id');
            $table->foreignId('disability_id')->nullable()->after('indigenous_id');

            $table->foreign('indigenous_id')
                  ->references('indigenous_id')
                  ->on('college_shs_indigenous')
                  ->onDelete('set null');

            $table->foreign('disability_id')
                  ->references('disability_id')
                  ->on('college_shs_disability')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('shs_students', function (Blueprint $table) {
            $table->dropForeign(['indigenous_id']);
            $table->dropForeign(['disability_id']);
            $table->dropColumn(['indigenous_id', 'disability_id']);
        });
    }
};