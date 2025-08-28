<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShsBranchesSeeder extends Seeder
{
    public function run()
    {
        DB::table('shs_branches')->insert([
            ['branch_name' => 'Main Branch'],
            ['branch_name' => 'Bulacan Branch'],
        ]);
    }
}