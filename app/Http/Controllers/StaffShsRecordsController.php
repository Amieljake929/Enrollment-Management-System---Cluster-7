<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class StaffShsRecordsController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get('https://sisreg.jampzdev.com/api/forEnrollment.php?key=RegistrarAPIKeyPass');

        if ($response->failed()) {
            return back()->with('error', 'API connection failed.');
        }

        $jsonData = $response->json();
        $allRecords = collect($jsonData['data'] ?? []);

        $strands = [
            'ABM' => 'ABM - Accountancy, Business and Management',
            'GAS' => 'GAS - General Academic Strand',
            'HECT' => 'HECT - Home Economics - Culinary Arts and Food Services',
            'HEHRS' => 'HEHRS - Home Economics Hotel and Restaurant Services',
            'HEHO' => 'HEHO - Home Economics Hotel Operation',
            'HETEM' => 'HETEM - Home Economics Tourism and Event Management',
            'HUMSS' => 'HUMSS - Humanities and Social Sciences',
            'ICT-HW' => 'ICT-HW - ICT Hardware',
            'ICT-CP' => 'ICT-CP - ICT-Programming',
            'ICT Animation' => 'ICT Animation - ICT-Animation',
            'ICT CCS' => 'ICT CCS - ICT-Contact Center Services',
            'ICT Visual Graphics' => 'ICT Visual Graphics - ICT Visual Graphics',
            'STEM' => 'STEM - Science, Technology, Engineering and Mathematics',
            'STEM PBM' => 'STEM PBM - STEM-Pre-Baccalaureate Maritime',
            'Bulacan ABM' => 'Bulacan ABM - Accountancy, Business and Management',
            'Bulacan HUMSS' => 'Bulacan HUMSS - Humanities and Social Sciences',
            'Bulacan GAS' => 'Bulacan GAS - General Academic Strand',
            'Bulacan SMAW' => 'Bulacan SMAW - Shielded Metal Arc Welding',
            'Bulacan SPORTS' => 'Bulacan SPORTS - Sport Track',
            'Bulacan AUTO' => 'Bulacan AUTO - Automotive',
            'Bulacan ICT' => 'Bulacan ICT - Information and Communications Technology',
            'Bulacan HE' => 'Bulacan HE - Home Economics',
            'Bulacan STEM' => 'Bulacan STEM - Science, Technology, Engineering and Mathematics',
        ];

        $groupedData = [];

        foreach ($strands as $code => $fullName) {
            $studentsInStrand = $allRecords->filter(fn($item) => ($item['EnrolledCourse'] ?? '') === $fullName);

            $groupedData[$code] = $studentsInStrand->groupBy('Section')->map(function ($group) {
                $firstStudent = $group->first();
                $gradeLevel = $firstStudent['EnrolledYearLevel'] ?? 'N/A';

                $uniqueStudents = $group->unique('StudentID')->map(function ($student) {
                    $middleName = $student['MiddleName'] ?? '';
                    $middleInitial = ($middleName && strtoupper($middleName) !== 'N/A') 
                                    ? strtoupper(substr($middleName, 0, 1)) . '.' 
                                    : '';

                    return [
                        'StudentID' => $student['StudentID'],
                        'FullName' => strtoupper("{$student['LastName']}, {$student['FirstName']} {$middleInitial}"),
                        'EnrollmentStatus' => $student['EnrollmentStatus'] ?? 'Enrolled',
                        'Section' => $student['Section'],
                        'YearLevel' => $student['EnrolledYearLevel'] ?? 'N/A'
                    ];
                });

                return [
                    'student_count' => $uniqueStudents->count(),
                    'grade_level' => $gradeLevel,
                    'students' => $uniqueStudents
                ];
            });
        }

        if ($request->ajax()) {
            return view('modules.staff.recordsShs', compact('strands', 'groupedData'))->render();
        }

        return view('modules.staff.recordsShs', compact('strands', 'groupedData'));
    }
}