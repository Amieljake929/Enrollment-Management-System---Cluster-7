<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeYearLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('college_year_levels')->insert([
        ['level_name' => '1st Year'],
        ['level_name' => '2nd Year'],
        ['level_name' => '3rd Year'],
        ['level_name' => '4th Year'],
        ['level_name' => '5th Year'],
    ]);
}
}
