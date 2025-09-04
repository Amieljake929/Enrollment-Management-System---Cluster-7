<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeShsIndigenousSeeder extends Seeder
{
    public function run()
    {
        $groups = [
            'Not Applicable',
            'Aeta',
            'Badjao',
            'Igorot',
            'Lumad',
            'Mangyan',
            'Manobo',
            'Tausug',
            'T\'boli',
            'Yakan'
        ];

        foreach ($groups as $group) {
            DB::table('college_shs_indigenous')->updateOrInsert(
                ['indigenous_name' => $group]
            );
        }
    }
}