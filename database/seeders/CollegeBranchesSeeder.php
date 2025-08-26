<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeBranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('college_branches')->insert([
        ['branch_name' => 'Main Branch'],
        ['branch_name' => 'Bulacan Branch'],
    ]);
}
}
