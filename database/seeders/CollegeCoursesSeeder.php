<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Main Branch (branch_id = 1)
    $mainCourses = [
        'BLIS - Bachelor in Library Information Science',
        'BPED - Bachelor in Physical Education',
        'BEED - Bachelor of Elementary Education',
        'BSAIS - BS in Accounting Information System',
        'BSBA FM - BSBA major in Financial Management',
        'BSBA HRM - BSBA major in Human Resource Management',
        'BSBA MM - BSBA major in Marketing Management',
        'BSCPE - BS in Computer Engineering',
        'BSCRIM - BS in Criminology',
        'BSENTREP - BS in Entrepreneurship',
        'BSHM - BS in Hospitality Management',
        'BSIT - BS in Information Technology',
        'BSOA - BS in Office Administration',
        'BSP - BS in Psychology',
        'BSTM - BS in Tourism Management',
        'BSED english - BSEd major in English',
        'BSED filipino - BSEd major in Filipino',
        'BSED math - BSEd major in Mathematics',
        'BSED science - BSEd major in Science',
        'BSED social studies - BSEd major in Social Studies',
        'BSED values - BSEd major in Values',
        'BTLED - Bachelor of Technology and Livelihood Education',
        'CPE - Certificate of Professional Education',
    ];

    foreach ($mainCourses as $course) {
        DB::table('college_courses')->insert([
            'course_name' => $course,
            'branch_id' => 1,
        ]);
    }

    // Bulacan Branch (branch_id = 2)
    $bulacanCourses = [
        'Bulacan BTVTED - BTVTED major in Food Service Management',
        'Bulacan BPE - Bachelor of Physical Education major in School PE',
        'Bulacan BSAIS - Bachelor of Science in Accounting Information System',
        'Bulacan BSCPE - Bachelor of Science in Computer Engineering',
        'Bulacan BSCRIM - Bachelor of Science in Criminology',
        'Bulacan BSENTREP - Bachelor of Science in Entrepreneurship',
        'Bulacan BSIS - Bachelor of Science in Information System',
        'Bulacan BSP - Bachelor of Science in Psychology',
        'Bulacan BSTM - Bachelor of Science in Tourism Management',
    ];

    foreach ($bulacanCourses as $course) {
        DB::table('college_courses')->insert([
            'course_name' => $course,
            'branch_id' => 2,
        ]);
    }
}
}
