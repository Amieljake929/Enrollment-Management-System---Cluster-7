<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollegeStudent;
use App\Models\CollegeStudentNumber;
use App\Models\ShsStudentNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentApiController extends Controller
{
    /**
     * Kunin ang data ng isang specific na estudyante (Dapat Paid)
     */
    public function getStudentData($id)
    {
        $student = CollegeStudent::with([
            'status', 'parentInfo', 'guardian', 'educationalBackground', 
            'enrolleeNumber', 'type', 'indigenous', 'disability', 
            'preference.branch', 'preference.course'
        ])
        ->where('student_id', $id)
        ->whereHas('status', function($query) {
            $query->where('payment', 'Paid');
        })
        ->first();

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found or payment status is not yet settled.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatStudentData($student)
        ], 200);
    }

    /**
     * Kunin ang lahat ng estudyante na may status na "Paid"
     */
    public function getAllPaidStudents()
    {
        $students = CollegeStudent::with([
            'status', 'parentInfo', 'guardian', 'educationalBackground', 
            'enrolleeNumber', 'type', 'indigenous', 'disability', 
            'preference.branch', 'preference.course'
        ])
        ->whereHas('status', function($query) {
            $query->where('payment', 'Paid');
        })
        ->get();

        if ($students->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No paid students found.',
                'data' => []
            ], 200);
        }

        $formattedList = $students->map(function ($student) {
            return $this->formatStudentData($student);
        });

        return response()->json([
            'status' => 'success',
            'count' => $formattedList->count(),
            'data' => $formattedList
        ], 200);
    }

    /**
     * Kunin ang lahat ng estudyante na HINDI PA BAYAD (Not Paid o NULL)
     */
    public function getNotPaidStudents()
    {
        $students = CollegeStudent::with([
            'status', 'parentInfo', 'guardian', 'educationalBackground', 
            'enrolleeNumber', 'type', 'indigenous', 'disability', 
            'preference.branch', 'preference.course'
        ])
        ->whereHas('status', function($query) {
            $query->where('payment', '!=', 'Paid')
                  ->orWhereNull('payment');
        })
        ->get();

        if ($students->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No unpaid students found.',
                'data' => []
            ], 200);
        }

        $formattedList = $students->map(function ($student) {
            return $this->formatStudentData($student);
        });

        return response()->json([
            'status' => 'success',
            'count' => $formattedList->count(),
            'data' => $formattedList
        ], 200);
    }

    /**
     * API ENDPOINT: I-update ang payment status at MAG-GENERATE ng Student ID
     */
    public function updatePaymentStatus(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'payment_status' => 'required|string'
        ]);

        $statusRecord = DB::table('college_status')
            ->where('student_id', $request->student_id)
            ->first();

        if (!$statusRecord) {
            return response()->json([
                'status' => 'error',
                'message' => "Student ID: {$request->student_id} not found in college_status."
            ], 404);
        }

        DB::table('college_status')
            ->where('student_id', $request->student_id)
            ->update([
                'payment' => $request->payment_status,
                'updated_at' => now()
            ]);

        $generatedId = null;
        if ($request->payment_status === 'Paid') {
            
            $studentNumber = CollegeStudentNumber::firstOrCreate(
                ['student_id' => $request->student_id],
                ['student_id_number' => null]
            );

            if (empty($studentNumber->student_id_number)) {
                do {
                    $newId = '26' . mt_rand(100000, 999999);
                    
                    $exists = CollegeStudentNumber::where('student_id_number', $newId)->exists() || 
                             ShsStudentNumber::where('student_id_number', $newId)->exists();

                } while ($exists);

                $studentNumber->update(['student_id_number' => $newId]);
                $generatedId = $newId;
            } else {
                $generatedId = $studentNumber->student_id_number;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "Payment status updated to '{$request->payment_status}'.",
            'student_id_number' => $generatedId ?? "N/A"
        ], 200);
    }

    /**
     * PRIVATE HELPER: Template para sa student data format
     */
    private function formatStudentData($student)
    {
        // Kunin ang student_id_number
        $studentNumberRecord = DB::table('college_student_number')
            ->where('student_id', $student->student_id)
            ->first();

        // KUKUNIN ANG ENROLLEE NO MULA SA TABLE: college_enrollee_number
        $enrolleeNumberRecord = DB::table('college_enrollee_number')
            ->where('student_id', $student->student_id)
            ->first();

        return [
            'student_id'          => $student->student_id,
            'student_id_number'   => $studentNumberRecord->student_id_number ?? "N/A", 
            'enrollee_no'         => $enrolleeNumberRecord->enrollee_no ?? "N/A", // Ito ang bagong field
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
                'remarks'     => $student->status->remarks ?? null,
            ],

            'parent_info' => $student->parentInfo->map(function ($parent) {
                return [
                    'parent_id'      => $parent->parent_id,
                    'parent_type'    => $parent->parent_type,
                    'first_name'     => $parent->first_name,
                    'last_name'      => $parent->last_name,
                    'contact_number' => $parent->contact_number,
                ];
            }),

            'guardian' => $student->guardian,
            'educational_background' => $student->educationalBackground,
            
            // Re-checked enrollee number from relation if available
            'enrollee_number' => $enrolleeNumberRecord->enrollee_no ?? ($student->enrolleeNumber->enrollee_no ?? null),

            'type' => [
                'type_name' => $student->type->type_name ?? "N/A",
            ],

            'preference' => [
                'branch' => $student->preference->branch->branch_name ?? "N/A",
                'course' => $student->preference->course->course_name ?? "N/A",
                'level'  => "1st Year",
            ]
        ];
    }
}