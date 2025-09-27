<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\ShsStudent;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'preference.level',
            'enrolleeNumber' // ✅ Add this to load enrollee_no
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
            'enrollmentPreference.level',
            'enrolleeNumber' // ✅ Add this to load enrollee_no
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

    /**
     * Show College Student Details
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

    /**
 * Delete a pending college admission and all related data
 */
public function destroy($id)
{
    // Find the student with all related data (optional, but safe)
    $student = CollegeStudent::with([
        'preference',
        'educationalBackground',
        'parentInfo',
        'guardian',
        'documents',
        'enrolleeNumber'
    ])->findOrFail($id);

    // Laravel will automatically delete related records if:
    // - You have `onDelete('cascade')` in your migrations, OR
    // - You manually delete them (safer if cascade isn't set)

    // 👇 If you're NOT using foreign key cascade, delete related data manually:
    $student->educationalBackground?->delete();
    $student->parentInfo()->delete(); // if it's a relationship (hasMany)
    $student->guardian?->delete();
    $student->documents()->delete(); // assuming it's a hasMany
    $student->enrolleeNumber?->delete();
    $student->preference?->delete();

    // Finally, delete the main record
    $student->delete();

    return response()->json([
        'success' => true,
        'message' => 'Admission record and related data deleted successfully.'
    ]);
}

/**
 * Show SHS Student Details
 */
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

/**
 * Delete a pending SHS admission and all related data
 */
public function destroyShs($id)
{
    $student = ShsStudent::with([
        'enrollmentPreference',
        'educationalBackground',
        'parentInfo',
        'guardian',
        'documents',
        'enrolleeNumber'
    ])->findOrFail($id);

    // Manually delete related records (if no cascade)
    $student->educationalBackground?->delete();
    $student->parentInfo?->delete();
    $student->guardian?->delete();
    $student->documents()->delete();
    $student->enrolleeNumber?->delete();
    $student->enrollmentPreference?->delete();

    $student->delete();

    return response()->json([
        'success' => true,
        'message' => 'SHS admission record and related data deleted successfully.'
    ]);
}

public function downloadPdf(Request $request)
{
    // Reuse the same query logic as in index()
    $query = CollegeStudent::with([
        'preference.course',
        'preference.branch',
        'preference.level',
        'enrolleeNumber'
    ])->whereHas('preference', function ($q) {
        $q->whereNotNull('course_id')
          ->whereNotNull('branch_id')
          ->whereNotNull('level_id');
    });

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

    // Get **all** matching records (not paginated) for PDF
    $students = $query->get();

    // Generate PDF
    $pdf = Pdf::loadView('modules.pendingCollegePdf', compact('students'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('pending_admissions_' . now()->format('Y-m-d_H-i') . '.pdf');
}

// Add this method in PendingAdmissionController
public function downloadShsPdf(Request $request)
{
    $query = ShsStudent::with([
        'enrollmentPreference.course',
        'enrollmentPreference.branch',
        'enrollmentPreference.level',
        'enrolleeNumber'
    ])->whereHas('enrollmentPreference', function ($q) {
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

    // Filter by Year Level (Grade 11/12)
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

    $students = $query->get();

    $pdf = Pdf::loadView('modules.pendingShsPdf', compact('students'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('pending_shs_admissions_' . now()->format('Y-m-d_H-i') . '.pdf');
}

}
