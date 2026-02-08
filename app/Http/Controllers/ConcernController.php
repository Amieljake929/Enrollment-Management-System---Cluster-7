<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Concern;
use App\Mail\StudentConcernMail;

class ConcernController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_type' => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'concern_type' => 'required|string|max:255',
            'concern'      => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in all required fields correctly.',
                'errors'  => $validator->errors()
            ], 422);
        }

        $concern = Concern::create([
            'student_type'    => $request->student_type,
            'first_name'      => $request->first_name,
            'middle_name'     => $request->middle_name,
            'last_name'       => $request->last_name,
            'email'           => $request->email,
            'concern_type'    => $request->concern_type,
            'concern'         => $request->concern,
            'submission_date' => now(),
        ]);

        try {
            Mail::to('bestlinkcollegeofph@gmail.com')->send(new StudentConcernMail($concern));
        } catch (\Exception $e) {
            \Log::error("Mail Sending Failed: " . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your concern has been submitted successfully.'
        ]);
    }

    public function index()
    {
        $concerns = Concern::orderBy('submission_date', 'desc')->get();
        return view('modules.Concerns', compact('concerns'));
    }

    public function show($id)
    {
        $concern = Concern::findOrFail($id);
        
        // Check if it's an AJAX request (from the notification dropdown)
        if (request()->ajax()) {
            return response()->json($concern);
        }
        
        // For regular page requests, return the view
        return view('modules.Concerns.show', compact('concern'));
    }

    // NEW: Function para sa Mark as Completed
    public function complete(Request $request, $id)
    {
        $request->validate([
            'remarks' => 'required|string|min:5',
        ]);

        $concern = Concern::findOrFail($id);
        
        // Update the status and remarks
        $concern->update([
            'status' => 'Completed',
            'remarks' => $request->remarks
        ]);

        // Send Email Notification to Student
        try {
            $studentName = $concern->first_name . ' ' . $concern->last_name;
            $adminRemarks = $request->remarks;
            $subjectType = $concern->concern_type;

            Mail::raw("Hi $studentName,\n\nYour concern regarding '$subjectType' has been marked as COMPLETED.\n\nAdmin Remarks: $adminRemarks\n\nThank you!", function ($message) use ($concern) {
                $message->to($concern->email)
                        ->subject('Concern Resolved - Bestlink College');
            });
        } catch (\Exception $e) {
            \Log::error("Student Completion Mail Failed: " . $e->getMessage());
        }

        return response()->json([
            'success' => true, 
            'message' => 'Concern has been marked as completed and student has been notified.'
        ]);
    }

    /**
     * Get notifications for the notification dropdown
     * Returns pending concerns with unread status
     */
    public function getNotifications()
    {
        $concerns = Concern::where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($concern) {
                return [
                    'id' => $concern->id,
                    'subject' => $concern->concern_type,
                    'message' => $concern->concern,
                    'student_name' => $concern->first_name . ' ' . $concern->last_name,
                    'created_at' => $concern->created_at,
                    'is_read' => $concern->is_read ?? 0,
                ];
            });

        return response()->json([
            'success' => true,
            'concerns' => $concerns,
            'count' => $concerns->count()
        ]);
    }

    /**
     * Mark a specific concern as read
     */
    public function markAsRead($id)
    {
        $concern = Concern::find($id);
        if ($concern) {
            $concern->is_read = 1;
            $concern->save();
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Mark all concerns as read
     */
    public function markAllRead()
    {
        Concern::where('is_read', 0)
            ->where('status', 'Pending')
            ->update(['is_read' => 1]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Get count of unread pending concerns
     * For the notification badge counter
     */
    public function getUnreadCount()
    {
        $count = Concern::where('status', 'Pending')
            ->where('is_read', 0)
            ->count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }
}