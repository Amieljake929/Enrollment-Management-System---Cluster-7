<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShsCoursesSeeder extends Seeder
{
    public function run()
    {
        // Main Branch (branch_id = 1)
        $mainCourses = [
            'ABM - Accountancy, Business and Management',
            'GAS - General Academic Strand',
            'HECT - Home Economics - Culinary Arts and Food Services',
            'HEHRS - Home Economics Hotel and Restaurant Services',
            'HEHO - Home Economics Hotel Operation',
            'HETEM - Home Economics Tourism and Event Management',
            'HUMSS - Humanities and Social Sciences',
            'ICT-HW - ICT Hardware',
            'JCT-CP - ICT-Programming',
            'ICT Animation - ICT-Animation',
            'ICT CCS - ICT-Contact Center Services',
            'ICT Visual Graphics - ICT Visual Graphics',
            'STEM - Science, Technology, Engineering and Mathematics',
            'STEM PBM - STEM-Pre-Baccalaureate Maritime'
        ];

        // Bulacan Branch (branch_id = 2)
        $bulacanCourses = [
            'Bulacan ARM - Accountancy, Business and Management',
            'Bulacan HUMSS - Humanities and Social Sciences',
            'Bulacan GAS - General Academic Strand',
            'Bulacan SMAW - Shielded Metal Arc Welding',
            'Bulacan SPORTS - Sport Track',
            'Bulacan AUTO - Automotive',
            'Bulacan ICT - Information and Communications Technology',
            'Bulacan HE - Home Economics',
            'Bulacan STEM - Science, Technology, Engineering and Mathematics'
        ];

        foreach ($mainCourses as $course) {
            DB::table('shs_courses')->insert([
                'course_name' => $course,
                'branch_id' => 1
            ]);
        }

        foreach ($bulacanCourses as $course) {
            DB::table('shs_courses')->insert([
                'course_name' => $course,
                'branch_id' => 2
            ]);
        }
    }
}