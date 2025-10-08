<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\CollegeStudentType;
use App\Models\ShsStudent;
use App\Models\ShsStudentType;
use Illuminate\Http\Request;

class CancelledController extends Controller
{
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
        ->whereHas('preference', function ($q) {
            $q->whereNotNull('course_id')
              ->whereNotNull('branch_id')
              ->whereNotNull('level_id');
        })
        ->whereHas('status', function ($q) {
            $q->where('info_status', 'Cancelled');
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
        $studentTypes = CollegeStudentType::orderBy('type_id')->get(['type_id','type_name']);

        return view('modules.cancelledCollege', compact('students', 'studentTypes'));
    }

    /**
     * Show College Student Details (same as pending)
     */
    public function show($id)
    {
        $student = CollegeStudent::with([
            'type',
            'parentInfo',
            'guardian',
            'preference.course',
            'preference.branch',
            'preference.level',
            'educationalBackground',
            'documents.document',
            'enrolleeNumber',
            'indigenous',
            'disability'
        ])->findOrFail($id);

        return response()->json($student);
    }

    // ✅ SHS CANCELLED ADMISSIONS
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
        ->whereHas('enrollmentPreference', function ($q) {
            $q->whereNotNull('course_id')
              ->whereNotNull('branch_id')
              ->whereNotNull('level_id');
        })
        ->whereHas('status', function ($q) {
            $q->where('info_status', 'Cancelled');
        });

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
        $studentTypes = ShsStudentType::orderBy('type_id')->get(['type_id','type_name']);

        return view('modules.cancelledShs', compact('students', 'studentTypes'));
    }

    public function showShs($id)
    {
        $student = ShsStudent::with([
            'studentType',
            'parentInfo',
            'guardian',
            'enrollmentPreference.course',
            'enrollmentPreference.branch',
            'enrollmentPreference.level',
            'educationalBackground',
            'documents.document',
            'enrolleeNumber',
            'indigenous',
            'disability'
        ])->findOrFail($id);

        return response()->json($student);
    }
}