<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\ShsStudent;
use Illuminate\Http\Request;

class PendingAdmissionController extends Controller
{
    /**
     * College Pending Admissions
     */
    public function index(Request $request)
{
    $query = CollegeStudent::with([
        'preference.course',
        'preference.branch',
        'preference.level'
    ])
    ->whereHas('preference', function ($q) {
        $q->whereNotNull('course_id')
          ->whereNotNull('branch_id')
          ->whereNotNull('level_id');
    });

    // Filter by Branch
    if ($request->filled('branch')) {
        $query->whereHas('preference', function ($q) use ($request) {
            $q->where('branch_id', $request->branch);
        });
    }

    // Filter by Year Level
    if ($request->filled('year_level')) {
        $query->whereHas('preference', function ($q) use ($request) {
            $q->where('level_id', $request->year_level);
        });
    }

    // Search by Keywords
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('middle_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhereHas('preference.course', function ($q) use ($search) {
                  $q->where('course_name', 'like', "%{$search}%");
              });
        });
    }

    $students = $query->paginate(10)->appends($request->query());

    if ($request->ajax()) {
        return view('modules.pendingCollege', compact('students'))->render();
    }

    return view('modules.pendingCollege', compact('students'));
}

    /**
     * SHS Pending Admissions
     */
    public function shsIndex(Request $request)
{
    $query = ShsStudent::with([
        'enrollmentPreference.course',
        'enrollmentPreference.branch',
        'enrollmentPreference.level'
    ])
    ->whereHas('enrollmentPreference', function ($q) {
        $q->whereNotNull('course_id')
          ->whereNotNull('branch_id')
          ->whereNotNull('level_id');
    });

    // Filter by Branch
    if ($request->filled('branch')) {
        $query->whereHas('enrollmentPreference', function ($q) use ($request) {
            $q->where('branch_id', $request->branch);
        });
    }

    // Filter by Year Level
    if ($request->filled('year_level')) {
        $query->whereHas('enrollmentPreference', function ($q) use ($request) {
            $q->where('level_id', $request->year_level);
        });
    }

    // Search by Keywords
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('middle_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhereHas('enrollmentPreference.course', function ($q) use ($search) {
                  $q->where('course_name', 'like', "%{$search}%");
              });
        });
    }

    $students = $query->paginate(10)->appends($request->query());

    if ($request->ajax()) {
        return view('modules.pendingShs', compact('students'))->render();
    }

    return view('modules.pendingShs', compact('students'));
}
}