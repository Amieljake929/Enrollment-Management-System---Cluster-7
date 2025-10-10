<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\CollegeStudentNumber;
use App\Models\CollegeStatus;
use App\Models\CollegeStudentType;
use App\Models\ShsStudentType;
use App\Models\ShsStudentNumber;
use App\Models\ShsStudent;
use App\Models\ShsStatus;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class StaffWaitingController extends Controller
{
    /**
     * Display validated College admissions (Waiting List)
     */
    public function index(Request $request)
    {
        $query = CollegeStudent::with([
            'type',
            'status',
            'preference.course',
            'preference.branch',
            'preference.level',
            'enrolleeNumber'
        ])
        ->whereHas('status', function ($q) {
            $q->where('info_status', 'Validated'); // Only Validated
        })
        ->whereHas('preference', function ($q) {
            $q->whereNotNull('course_id')
              ->whereNotNull('branch_id')
              ->whereNotNull('level_id');
        });

        // Apply filters
        if ($request->filled('branch')) {
            $query->whereHas('preference', function ($q) use ($request) {
                $q->where('branch_id', $request->branch);
            });
        }

        if ($request->filled('year_level')) {
            $query->whereHas('preference', function ($q) use ($request) {
                $q->where('level_id', $request->year_level);
            });
        }

        if ($request->filled('student_type')) {
            $query->where('type_id', $request->student_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhereHas('preference.course', function ($q2) use ($search) {
                      $q2->where('course_name', 'like', "%{$search}%");
                  });
            });
        }

        $students = $query->paginate(10)->appends($request->query());
        $studentTypes = CollegeStudentType::orderBy('type_id')->get(['type_id', 'type_name']);

        return view('modules.staff.waitingCollege', compact('students', 'studentTypes'));
    }

    /**
     * Display validated SHS admissions (Waiting List)
     */
    public function shsIndex(Request $request)
    {
        $query = ShsStudent::with([
            'studentType',
            'status',
            'enrollmentPreference.course',
            'enrollmentPreference.branch',
            'enrollmentPreference.level',
            'enrolleeNumber'
        ])
        ->whereHas('status', function ($q) {
            $q->where('info_status', 'Validated'); // Only Validated
        })
        ->whereHas('enrollmentPreference', function ($q) {
            $q->whereNotNull('course_id')
              ->whereNotNull('branch_id')
              ->whereNotNull('level_id');
        });

        // Apply filters (same as pendingShs)
        if ($request->filled('branch')) {
            $query->whereHas('enrollmentPreference', function ($q) use ($request) {
                $q->where('branch_id', $request->branch);
            });
        }

        if ($request->filled('year_level')) {
            $query->whereHas('enrollmentPreference', function ($q) use ($request) {
                $q->where('level_id', $request->year_level);
            });
        }

        if ($request->filled('student_type')) {
            $query->where('type_id', $request->student_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhereHas('enrollmentPreference.course', function ($q2) use ($search) {
                      $q2->where('course_name', 'like', "%{$search}%");
                  });
            });
        }

        $students = $query->paginate(10)->appends($request->query());
        $studentTypes = ShsStudentType::orderBy('type_id')->get(['type_id', 'type_name']);

        return view('modules.staff.waitingShs', compact('students', 'studentTypes'));
    }
    public function updateCollegePaymentStatus(Request $request, $studentId)
{
    $status = CollegeStatus::where('student_id', $studentId)->firstOrFail();
    $status->payment = $request->payment; // e.g., "Paid"
    $status->save();

    if ($status->payment === 'Paid') {
        $studentNumber = CollegeStudentNumber::firstOrCreate(
            ['student_id' => $studentId],
            ['student_id_number' => null]
        );

        if (empty($studentNumber->student_id_number)) {
            $latest = CollegeStudentNumber::max('student_id_number');
            $newId = $latest ? intval($latest) + 1 : 22000001;
            $studentNumber->update(['student_id_number' => $newId]);
        }
    }

    return response()->json(['success' => true, 'message' => 'College payment status updated']);
}

public function updateShsPaymentStatus(Request $request, $studentId)
{
    $status = ShsStatus::where('student_id', $studentId)->firstOrFail();
    $status->payment = $request->payment;
    $status->save();

    if ($status->payment === 'Paid') {
        $studentNumber = ShsStudentNumber::firstOrCreate(
            ['student_id' => $studentId],
            ['student_id_number' => null]
        );

        if (empty($studentNumber->student_id_number)) {
            $latest = ShsStudentNumber::max('student_id_number');
            $newId = $latest ? intval($latest) + 1 : 22000001;
            $studentNumber->update(['student_id_number' => $newId]);
        }
    }

    return response()->json(['success' => true, 'message' => 'SHS payment status updated']);
}


}
