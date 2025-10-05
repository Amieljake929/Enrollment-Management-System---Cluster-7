<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShsStatus;
use App\Models\ShsStudent;

class ShsStatusSeeder extends Seeder
{
    public function run(): void
    {
        // Kunin lahat ng existing SHS students
        $students = ShsStudent::all();

        foreach ($students as $student) {
            ShsStatus::create([
                'student_id'  => $student->student_id,
                'info_status' => 'Pending',
                'payment'     => 'Not Paid',
                'remarks'     => 'Initial status created',
            ]);
        }
    }
}
