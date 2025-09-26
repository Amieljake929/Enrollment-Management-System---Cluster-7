<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeShsDisabilitySeeder extends Seeder
{
    public function run()
    {
        $types = [
            'Not Applicable',
            'Visual Impairment',
            'Hearing Impairment',
            'Speech Impairment',
            'Mobility Impairment',
            'Cognitive Impairment',
            'Psychosocial Disability',
            'Chronic Illness',
            'Multiple Disabilities'
        ];

        foreach ($types as $type) {
            DB::table('college_shs_disability')->updateOrInsert(
                ['disability_name' => $type]
            );
        }
    }
}