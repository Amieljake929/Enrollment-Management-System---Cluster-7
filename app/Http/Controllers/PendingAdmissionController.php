<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\ShsStudent;
use App\Models\CollegeStatus;
use App\Models\ShsStudentType;
use App\Models\ShsStatus;
use App\Models\CollegeStudentType;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnrollmentValidatedMail;

class PendingAdmissionController extends Controller
{
    /**
     * College Pending Admissions
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
    ->whereHas('preference', function ($q) {
        $q->whereNotNull('course_id')
          ->whereNotNull('branch_id')
          ->whereNotNull('level_id');
    })
    ->where(function ($q) {
        // Group: either has 'Pending' status OR has no status at all
        $q->whereHas('status', function ($sub) {
            $sub->where('info_status', 'Pending');
        })
        ->orWhereDoesntHave('status');
    });

    // ✅ Now apply filters (branch, year_level, etc.)
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

    // Date range filter
    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $students = $query->paginate(10)->appends($request->query());
    $studentTypes = CollegeStudentType::orderBy('type_id')->get(['type_id','type_name']);

    if ($request->ajax()) {
        return view('modules.pendingCollege', compact('students','studentTypes'))->render();
    }

    return view('modules.pendingCollege', compact('students','studentTypes'));
}


    /**
     * SHS Pending Admissions
     */
    public function shsIndex(Request $request)
{
    $query = ShsStudent::with([
        'studentType',
        'status', // 👈 DAPAT KASAMA ITO!
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
    ->where(function ($q) {
        // Only show: Pending OR no status yet
        $q->whereHas('status', function ($sub) {
            $sub->where('info_status', 'Pending');
        })
        ->orWhereDoesntHave('status');
    });

    // ✅ Filters (branch, year_level, etc.)
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

    // Date range filter
    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $students = $query->paginate(10)->appends($request->query());
    $studentTypes = ShsStudentType::orderBy('type_id')->get(['type_id','type_name']);

    if ($request->ajax()) {
        return view('modules.pendingShs', compact('students','studentTypes'))->render();
    }

    return view('modules.pendingShs', compact('students','studentTypes'));
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
    $query = CollegeStudent::with([
        'type', // 👈 include type for PDF if you'd like to show it
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

    // ✅ NEW: Student Type filter for PDF
    if ($request->filled('student_type')) {
        $query->where('type_id', $request->student_type);
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

    // Date range filter
    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $students = $query->get();

    $pdf = Pdf::loadView('modules.pendingCollegePdf', compact('students'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('pending_admissions_' . now()->format('Y-m-d_H-i') . '.pdf');
}


// Add this method in PendingAdmissionController
public function downloadShsPdf(Request $request)
{
    $query = ShsStudent::with([
        'studentType', // optional, if you want to show on PDF
        'status',
        'enrollmentPreference.course',
        'enrollmentPreference.branch',
        'enrollmentPreference.level',
        'enrolleeNumber'
    ])->whereHas('enrollmentPreference', function ($q) {
        $q->whereNotNull('course_id')
          ->whereNotNull('branch_id')
          ->whereNotNull('level_id');
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

    // ✅ NEW: Student Type filter for PDF
    if ($request->filled('student_type')) {
        $query->where('type_id', $request->student_type);
    }

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

    // Date range filter
    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $students = $query->get();

    $pdf = Pdf::loadView('modules.pendingShsPdf', compact('students'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('pending_shs_admissions_' . now()->format('Y-m-d_H-i') . '.pdf');
}

// ...

public function validate(Request $request, $id)
{
    $student = CollegeStudent::findOrFail($id);

    // Update or create status
    CollegeStatus::updateOrCreate(
        ['student_id' => $student->student_id],
        ['info_status' => 'Validated']
    );

    // Send email notification
    if ($student->email) {
        Mail::to($student->email)->send(new EnrollmentValidatedMail($student, $student->enrolleeNumber->enrollee_no ?? null, 'college'));
    }

    return response()->json(['success' => true, 'message' => 'Student validated successfully.']);
}

public function cancel(Request $request, $id)
{
    $student = CollegeStudent::findOrFail($id);

    CollegeStatus::updateOrCreate(
        ['student_id' => $student->student_id],
        ['info_status' => 'Cancelled']
    );

    return response()->json(['success' => true, 'message' => 'Student admission cancelled.']);
}

// Validate SHS Admission
public function validateShs(Request $request, $id)
{
    $student = ShsStudent::findOrFail($id);

    ShsStatus::updateOrCreate(
        ['student_id' => $student->student_id],
        ['info_status' => 'Validated']
    );

    // Send email notification
    if ($student->email) {
        Mail::to($student->email)->send(new EnrollmentValidatedMail($student, $student->enrolleeNumber->enrollee_no ?? null, 'shs'));
    }

    return response()->json(['success' => true, 'message' => 'SHS admission validated successfully.']);
}

// Cancel SHS Admission
public function cancelShs(Request $request, $id)
{
    $student = ShsStudent::findOrFail($id);

    ShsStatus::updateOrCreate(
        ['student_id' => $student->student_id],
        ['info_status' => 'Cancelled']
    );

    return response()->json(['success' => true, 'message' => 'SHS admission cancelled.']);
}
public function reevaluate(Request $request, $id)
{
    $student = CollegeStudent::findOrFail($id);
    CollegeStatus::updateOrCreate(
        ['student_id' => $student->student_id],
        ['info_status' => 'Re-Evaluate']
    );
    return response()->json(['success' => true, 'message' => 'Student status updated to Re-Evaluate.']);
}

// Re-Evaluate SHS Admission
public function reevaluateShs(Request $request, $id)
{
    $student = ShsStudent::findOrFail($id);
    ShsStatus::updateOrCreate(
        ['student_id' => $student->student_id],
        ['info_status' => 'Re-Evaluate']
    );
    return response()->json(['success' => true, 'message' => 'SHS admission status updated to Re-Evaluate.']);
}
}
