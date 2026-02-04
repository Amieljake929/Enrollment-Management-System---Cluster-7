<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShsStudent;
use App\Models\ShsStudentNumber; // Import Shs model
use App\Models\CollegeStudentNumber; // Import College model for cross-checking
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShsStudentApiController extends Controller
{
    public function getStudentData($id)
    {
        $student = ShsStudent::with([
            'status', 'parentInfo', 'guardian', 'educationalBackground', 
            'enrolleeNumber', 'studentType', 'indigenous', 'disability', 
            'enrollmentPreference.branch', 'enrollmentPreference.course'
        ])
        ->where('student_id', $id)
        ->whereHas('status', function($query) {
            $query->where('payment', 'Paid');
        })
        ->first();

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'SHS Student not found or status is not Paid.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatShsData($student)
        ], 200);
    }

    public function getAllPaidShsStudents()
    {
        $students = ShsStudent::with([
            'status', 'parentInfo', 'guardian', 'educationalBackground', 
            'enrolleeNumber', 'studentType', 'indigenous', 'disability', 
            'enrollmentPreference.branch', 'enrollmentPreference.course'
        ])
        ->whereHas('status', function($query) {
            $query->where('payment', 'Paid');
        })
        ->get();

        if ($students->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No paid SHS students found.',
                'data' => []
            ], 200);
        }

        $formattedList = $students->map(function ($student) {
            return $this->formatShsData($student);
        });

        return response()->json([
            'status' => 'success',
            'count' => $formattedList->count(),
            'data' => $formattedList
        ], 200);
    }

    /**
     * Kunin ang lahat ng SHS students na Not Paid o NULL
     */
    public function getNotPaidShsStudents()
    {
        $students = ShsStudent::with([
            'status', 'parentInfo', 'guardian', 'educationalBackground', 
            'enrolleeNumber', 'studentType', 'indigenous', 'disability', 
            'enrollmentPreference.branch', 'enrollmentPreference.course'
        ])
        ->whereHas('status', function($query) {
            $query->where('payment', '!=', 'Paid')
                  ->orWhereNull('payment');
        })
        ->get();

        if ($students->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No unpaid SHS students found.',
                'data' => []
            ], 200);
        }

        $formattedList = $students->map(function ($student) {
            return $this->formatShsData($student);
        });

        return response()->json([
            'status' => 'success',
            'count' => $formattedList->count(),
            'data' => $formattedList
        ], 200);
    }

    /**
     * API ENDPOINT: I-update ang payment status ng SHS gamit ang EMAIL
     */
    public function updateShsPaymentStatus(Request $request)
    {
        // Pinalitan ang student_id ng email sa validation
        $request->validate([
            'email' => 'required|email',
            'payment_status' => 'required|string'
        ]);

        // 1. Hanapin muna ang SHS student gamit ang email
        $student = ShsStudent::where('email', $request->email)->first();

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => "SHS Student with email: {$request->email} not found."
            ], 404);
        }

        $studentId = $student->student_id;

        // 2. Check sa shs_status table gamit ang nakuha nating studentId
        $statusRecord = DB::table('shs_status')
            ->where('student_id', $studentId)
            ->first();

        if (!$statusRecord) {
            return response()->json([
                'status' => 'error',
                'message' => "Status record for SHS Student not found."
            ], 404);
        }

        // 3. Update status sa database
        DB::table('shs_status')
            ->where('student_id', $studentId)
            ->update([
                'payment' => $request->payment_status,
                'updated_at' => now()
            ]);

        // 4. Logic Generation ng Student ID
        $generatedId = null;
        if ($request->payment_status === 'Paid') {
            $studentNumber = ShsStudentNumber::firstOrCreate(
                ['student_id' => $studentId],
                ['student_id_number' => null]
            );

            if (empty($studentNumber->student_id_number)) {
                do {
                    $newId = '26' . mt_rand(100000, 999999);
                    $exists = ShsStudentNumber::where('student_id_number', $newId)->exists() || 
                             CollegeStudentNumber::where('student_id_number', $newId)->exists();
                } while ($exists);

                $studentNumber->update(['student_id_number' => $newId]);
                $generatedId = $newId;
            } else {
                $generatedId = $studentNumber->student_id_number;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "SHS Payment status updated successfully for {$request->email}.",
            'student_id_number' => $generatedId ?? "N/A"
        ], 200);
    }

    private function formatShsData($student)
    {
        // Kunin ang student_id_number mula sa shs_student_number table
        $shsNumber = DB::table('shs_student_number')
            ->where('student_id', $student->student_id)
            ->first();

        // Kunin ang enrollee_no mula sa shs_enrollee_number table
        $shsEnrolleeNumber = DB::table('shs_enrollee_number')
            ->where('student_id', $student->student_id)
            ->first();

        return [
            'student_id'          => $student->student_id,
            'student_id_number'   => $shsNumber->student_id_number ?? "N/A",
            'enrollee_no'         => $shsEnrolleeNumber->enrollee_no ?? "N/A",
            'first_name'          => $student->first_name,
            'middle_name'         => $student->middle_name,
            'last_name'           => $student->last_name,
            'extension_name'      => $student->extension_name,
            'civil_status'        => $student->civil_status,
            'gender'              => $student->gender,
            'dob'                 => $student->dob,
            'place_of_birth'      => $student->place_of_birth,
            'nationality'         => $student->nationality,
            'previous_student_id' => $student->previous_student_id,
            'contact_number'      => $student->contact_number,
            'email'               => $student->email,
            'social_media'        => $student->social_media,
            'religion'            => $student->religion,
            'current_address'     => $student->current_address,
            'city_municipality'   => $student->city_municipality,
            'province'            => $student->province,
            'zip_code'            => $student->zip_code,
            'region'              => "NCR - National Capital Region",
            'indigenous'          => $student->indigenous->indigenous_name ?? "Not Applicable",
            'disability'          => $student->disability->disability_name ?? "Not Applicable",
            
            'status' => [
                'info_status' => $student->status->info_status ?? null,
                'payment'     => $student->status->payment ?? null,
                'remarks'     => $student->status->remarks ?? null
            ],

            'parent_info' => [
                [
                    'parent_id'          => $student->parentInfo->parent_id ?? null,
                    'mother_first_name'  => $student->parentInfo->mother_first_name ?? null,
                    'mother_last_name'   => $student->parentInfo->mother_last_name ?? null,
                    'mother_contact'     => $student->parentInfo->mother_contact ?? null,
                ],
                [
                    'parent_id'          => $student->parentInfo->parent_id ?? null,
                    'father_first_name'  => $student->parentInfo->father_first_name ?? null,
                    'father_last_name'   => $student->parentInfo->father_last_name ?? null,
                    'father_contact'     => $student->parentInfo->father_contact ?? null,
                ]
            ],

            'guardian' => $student->guardian,
            'educational_background' => $student->educationalBackground,
            'enrollee_number' => $shsEnrolleeNumber->enrollee_no ?? ($student->enrolleeNumber->enrollee_no ?? "N/A"),
            
            'type' => [
                'type_name' => $student->studentType->type_name ?? "N/A"
            ],

            'preference' => [
                'branch' => $student->enrollmentPreference->branch->branch_name ?? "N/A",
                'course' => $student->enrollmentPreference->course->course_name ?? "N/A",
                'level'  => ($student->enrollmentPreference->level_id == 11) ? "Grade 11" : (($student->enrollmentPreference->level_id == 12) ? "Grade 12" : "N/A")
            ]
        ];
    }
}