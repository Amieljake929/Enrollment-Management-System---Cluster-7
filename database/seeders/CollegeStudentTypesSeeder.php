<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeStudentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('college_student_types')->insert([
        ['type_name' => 'New Regular'],
        ['type_name' => 'Transferee'],
        ['type_name' => 'Returnee'],
    ]);
}
}
