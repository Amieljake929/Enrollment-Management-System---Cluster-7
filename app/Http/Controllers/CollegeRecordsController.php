<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CollegeRecordsController extends Controller
{
    public function index()
    {
        $response = Http::get('https://sisreg.jampzdev.com/api/forEnrollment.php?key=RegistrarAPIKeyPass');

        if ($response->failed()) {
            return back()->with('error', 'API connection failed.');
        }

        $jsonData = $response->json();
        $allRecords = collect($jsonData['data'] ?? []);

        $courses = [
            'BLIS' => 'BLIS - Bachelor in Library Information Science',
            'BPED' => 'BPED - Bachelor in Physical Education',
            'BEED' => 'BEED - Bachelor of Elementary Education',
            'BSAIS' => 'BSAIS - BS in Accounting Information System',
            'BSBA FM' => 'BSBA FM - BSBA major in Financial Management',
            'BSBA HRM' => 'BSBA HRM - BSBA major in Human Resource Management',
            'BSBA MM' => 'BSBA MM - BSBA major in Marketing Management',
            'BSCPE' => 'BSCPE - BS in Computer Engineering',
            'BSCRIM' => 'BSCRIM - BS in Criminology',
            'BSENTREP' => 'BSENTREP - BS in Entrepreneurship',
            'BSHM' => 'BSHM - BS in Hospitality Management',
            'BSIT' => 'BSIT - BS in Information Technology',
            'BSOA' => 'BSOA - BS in Office Administration',
            'BSP' => 'BSP - BS in Psychology',
            'BSTM' => 'BSTM - BS in Tourism Management',
            'BSED english' => 'BSED english - BSEd major in English',
            'BSED filipino' => 'BSED filipino - BSEd major in Filipino',
            'BSED math' => 'BSED math - BSEd major in Mathematics',
            'BSED science' => 'BSED science - BSEd major in Science',
            'BSED social studies' => 'BSED social studies - BSEd major in Social Studies',
            'BSED values' => 'BSED values - BSEd major in Values',
            'BTLED' => 'BTLED - Bachelor of Technology and Livelihood Education',
            'CPE' => 'CPE - Certificate of Professional Education',
            'BTVTED' => 'Bulacan BTVTED - BTVTED major in Food Service Management',
            'BPE' => 'Bulacan BPE - Bachelor of Physical Education major in School PE',
            'Bulacan BSAIS' => 'Bulacan BSAIS - Bachelor of Science in Accounting Information System',
            'Bulacan BSCPE' => 'Bulacan BSCPE - Bachelor of Science in Computer Engineering',
            'Bulacan BSCRIM' => 'Bulacan BSCRIM - Bachelor of Science in Criminology',
            'Bulacan BSENTREP' => 'Bulacan BSENTREP - Bachelor of Science in Entrepreneurship',
            'BSIS' => 'Bulacan BSIS - Bachelor of Science in Information System',
            'Bulacan BSP' => 'Bulacan BSP - Bachelor of Science in Psychology',
            'Bulacan BSTM' => 'Bulacan BSTM - Bachelor of Science in Tourism Management',
        ];

        $groupedData = [];

        foreach ($courses as $code => $fullName) {
            $studentsInCourse = $allRecords->filter(fn($item) => ($item['EnrolledCourse'] ?? '') === $fullName);

            $groupedData[$code] = $studentsInCourse->groupBy('Section')->map(function ($group) {
                $uniqueStudents = $group->unique('StudentID')->map(function ($student) {
                    
                    $middleName = $student['MiddleName'] ?? '';
                    $middleInitial = ($middleName && strtoupper($middleName) !== 'N/A') 
                                    ? strtoupper(substr($middleName, 0, 1)) . '.' 
                                    : '';

                    return [
                        'StudentID' => $student['StudentID'],
                        'FullName' => strtoupper("{$student['LastName']}, {$student['FirstName']} {$middleInitial}"),
                        'FirstName' => $student['FirstName'],
                        'LastName' => $student['LastName'],
                        'MiddleName' => $student['MiddleName'],
                        'EnrollmentStatus' => $student['CurrentEnrollmentStatus'] ?? 'Enrolled',
                        'Section' => $student['Section'],
                        'YearLevel' => $student['EnrolledYearLevel'] ?? 'N/A',
                        // Karagdagang details para sa Modal
                        'Gender' => $student['Gender'] ?? 'N/A',
                        'DOB' => $student['DateOfBirth'] ?? 'N/A',
                        'Email' => $student['email'] ?? 'N/A',
                        'Contact' => $student['ContactInfo'] ?? 'N/A',
                        'Address' => $student['Address'] ?? 'N/A',
                        'Balance' => $student['Balance'] ?? '0.00',
                        'Course' => $student['EnrolledCourse'] ?? 'N/A',
                    ];
                });

                return [
                    'student_count' => $uniqueStudents->count(),
                    'students' => $uniqueStudents
                ];
            });
        }

        return view('modules.recordsCollege', compact('courses', 'groupedData'));
    }
}