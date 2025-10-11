<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CollegeStatus;
use App\Models\ShsStatus;
use App\Models\CollegeStudent;
use App\Models\ShsStudent;
use App\Models\ArchiveLog;

class ArchiveController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'Administrator (OIC)') {
                abort(403, 'Access Denied. Only Administrator (OIC) can manage archived records.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->has('content') && session('archive_access')) {
            $query = ArchiveLog::with(['collegeStudent', 'shsStudent'])->where('action', 'Archive');

            // Search by name
            if ($request->has('search') && $request->search) {
                $query->where('student_name', 'like', '%' . $request->search . '%');
            }

            // Filter by original_status (repurposed from category for task categories)
            if ($request->has('category') && $request->category) {
                $query->where('original_status', $request->category);
            }

            // Sort by date archived (created_at)
            $sort = $request->get('sort', 'desc');
            $query->orderBy('created_at', $sort);

            $archivedRecords = $query->paginate(10);

            return view('modules.archive', compact('archivedRecords'));
        } else {
            return view('modules.archive-auth');
        }
    }

public function store(Request $request)
{
    $request->validate([
        'password' => 'required',
    ]);

    if (!Hash::check($request->password, Auth::user()->password)) {
        return response()->json(['error' => 'Incorrect password.'], 400);
    }

    $eligibleStatuses = ['Pending', 'Cancelled', 'Validated', 'Re-Evaluate'];

    if ($request->filled('student_id') && $request->filled('category')) {
        // Individual archiving
        $request->validate([
            'student_id' => 'required|integer',
            'category' => 'required|in:College,SHS',
            'student_name' => 'required|string|max:255',
            'archive_date' => 'required|date',
            'attached_by' => 'required|string|max:255',
        ]);

        $originalStatus = null;
        if ($request->category === 'College') {
            $status = CollegeStatus::where('student_id', $request->student_id)->firstOrFail();
            if (!in_array($status->info_status, $eligibleStatuses)) {
                return response()->json(['error' => 'Student not eligible for archiving.'], 400);
            }
            $originalStatus = $status->info_status;
            $status->update(['info_status' => 'Archived']);
        } else {
            $status = ShsStatus::where('student_id', $request->student_id)->firstOrFail();
            if (!in_array($status->info_status, $eligibleStatuses)) {
                return response()->json(['error' => 'Student not eligible for archiving.'], 400);
            }
            $originalStatus = $status->info_status;
            $status->update(['info_status' => 'Archived']);
        }

        ArchiveLog::create([
            'admin_name' => $request->attached_by,
            'student_name' => $request->student_name,
            'record_id' => $request->student_id,
            'action' => 'Archive',
            'category' => $request->category,
            'original_status' => $originalStatus,
            // Note: archive_date validated but not stored in model (use created_at auto-timestamp)
        ]);

        return response()->json(['success' => 'Record archived successfully.']);
    } else {
        // Bulk archiving
        // Archive College
        $collegeRecords = CollegeStatus::whereIn('info_status', $eligibleStatuses)->with('student')->get();
        foreach ($collegeRecords as $record) {
            $originalStatus = $record->info_status;
            $record->update(['info_status' => 'Archived']);

            if ($record->student) {
                $studentName = $record->student->first_name . ' ' . ($record->student->middle_name ? $record->student->middle_name . ' ' : '') . $record->student->last_name;

                ArchiveLog::create([
                    'admin_name' => Auth::user()->name,
                    'student_name' => $studentName ?? 'Unknown',
                    'record_id' => $record->student_id,
                    'action' => 'Archive',
                    'category' => 'College',
                    'original_status' => $originalStatus,
                ]);
            }
        }

        // Archive SHS
        $shsRecords = ShsStatus::whereIn('info_status', $eligibleStatuses)->with('student')->get();
        foreach ($shsRecords as $record) {
            $originalStatus = $record->info_status;
            $record->update(['info_status' => 'Archived']);

            if ($record->student) {
                $studentName = $record->student->first_name . ' ' . ($record->student->middle_name ? $record->student->middle_name . ' ' : '') . $record->student->last_name;

                ArchiveLog::create([
                    'admin_name' => Auth::user()->name,
                    'student_name' => $studentName ?? 'Unknown',
                    'record_id' => $record->student_id,
                    'action' => 'Archive',
                    'category' => 'SHS',
                    'original_status' => $originalStatus,
                ]);
            }
        }

        return response()->json(['success' => 'Records archived successfully.']);
    }
}

    public function restore(Request $request, $id)
    {
        $log = ArchiveLog::findOrFail($id);

        if ($log->category === 'College') {
            $status = CollegeStatus::where('student_id', $log->record_id)->first();
        } else {
            $status = ShsStatus::where('student_id', $log->record_id)->first();
        }

        if ($status) {
            $status->update(['info_status' => $log->original_status]);

            ArchiveLog::create([
                'admin_name' => Auth::user()->name,
                'student_name' => $log->student_name,
                'record_id' => $log->record_id,
                'action' => 'Restore',
                'category' => $log->category,
                'original_status' => $log->original_status,
            ]);
        }

        return redirect()->back()->with('success', 'Record restored successfully.');
    }

    public function show($id)
    {
        if (!session('archive_access')) {
            return redirect()->route('modules.archive')->with('error', 'Access denied. Please authenticate to access archived records.');
        }

        $log = ArchiveLog::findOrFail($id);

        if ($log->category === 'College') {
            $student = $log->collegeStudent;
        } else {
            $student = $log->shsStudent;
        }

        return view('modules.archive-show', compact('student', 'log'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json(['error' => 'Incorrect password.'], 400);
        }

        session(['archive_access' => true]);

        return response()->json(['success' => 'Access granted.']);
    }

    public function clearAccess()
    {
        session()->forget('archive_access');
        return response()->json(['success' => 'Access cleared.']);
    }
}
