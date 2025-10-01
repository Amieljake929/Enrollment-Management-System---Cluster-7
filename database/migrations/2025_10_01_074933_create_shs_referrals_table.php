<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_shs_referral_table.php
public function up()
{
    Schema::create('shs_referral', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id');
        $table->enum('referral_source', [
            'Social Media Account',
            'Adviser/Referral/Others',
            'Walk-in/No Referral'
        ]);
        $table->string('referral_name')->nullable();
        $table->string('referral_relation')->nullable();
        $table->timestamps();

        $table->foreign('student_id')
              ->references('student_id')
              ->on('shs_students')
              ->onDelete('cascade');
    });
}
};
