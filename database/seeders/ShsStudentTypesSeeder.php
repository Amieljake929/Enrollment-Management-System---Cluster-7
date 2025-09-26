<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShsStudentTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('shs_student_types')->insert([
            ['type_name' => 'New Regular'],
            ['type_name' => 'Transferee'],
            ['type_name' => 'Returnee'],
        ]);
    }
}