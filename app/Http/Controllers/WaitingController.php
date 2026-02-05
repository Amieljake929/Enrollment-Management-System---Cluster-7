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

class WaitingController extends Controller
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
            // Only Validated and NOT Paid
            $q->where('info_status', 'Validated')
              ->where(function($sub) {
                  $sub->where('payment', '!=', 'Paid')
                      ->orWhereNull('payment');
              });
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

        return view('modules.waitingCollege', compact('students', 'studentTypes'));
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
            'enrolleeNumber',
            'studentNumber'
        ])
        ->whereHas('status', function ($q) {
            // Only Validated and NOT Paid
            $q->where('info_status', 'Validated')
              ->where(function($sub) {
                  $sub->where('payment', '!=', 'Paid')
                      ->orWhereNull('payment');
              });
        })
        ->whereHas('enrollmentPreference', function ($q) {
            $q->whereNotNull('course_id')
              ->whereNotNull('branch_id')
              ->whereNotNull('level_id');
        });

        // Apply filters
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

        return view('modules.waitingShs', compact('students', 'studentTypes'));
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
                do {
                    $newId = '26' . mt_rand(100000, 999999);
                    $exists = CollegeStudentNumber::where('student_id_number', $newId)->exists() || 
                             ShsStudentNumber::where('student_id_number', $newId)->exists();
                } while ($exists);

                $studentNumber->update(['student_id_number' => $newId]);
            }
        }

        return redirect()->back()->with('success', 'College payment status updated successfully.');
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
                do {
                    $newId = '26' . mt_rand(100000, 999999);
                    $exists = CollegeStudentNumber::where('student_id_number', $newId)->exists() || 
                             ShsStudentNumber::where('student_id_number', $newId)->exists();
                } while ($exists);

                $studentNumber->update(['student_id_number' => $newId]);
            }
        }

        return redirect()->back()->with('success', 'SHS payment status updated successfully.');
    }
}