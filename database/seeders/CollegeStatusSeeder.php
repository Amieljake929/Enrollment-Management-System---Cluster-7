<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CollegeStatus;
use App\Models\CollegeStudent;

class CollegeStatusSeeder extends Seeder
{
    public function run(): void
    {
        // Kunin lahat ng existing students
        $students = CollegeStudent::all();

        foreach ($students as $student) {
            CollegeStatus::create([
                'student_id'  => $student->student_id,
                'info_status' => 'Pending',
                'payment'     => 'Not Paid',
                'remarks'     => 'Waiting for validation',
            ]);
        }
    }
}
