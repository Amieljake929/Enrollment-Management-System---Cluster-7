<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class StaffConcernController extends Controller
{
    public function index()
    {
        $concerns = Concern::orderBy('submission_date', 'desc')->get();
        return view('modules.staff.concerns', compact('concerns'));
    }
    
    public function show($id)
    {
        $concern = Concern::findOrFail($id);
        return response()->json($concern);
    }

    public function complete(Request $request, $id)
    {
        $request->validate([
            'remarks' => 'required|string|min:5',
        ]);

        $concern = Concern::findOrFail($id);
        
        $concern->update([
            'status' => 'Completed',
            'remarks' => $request->remarks
        ]);

        // Email Notification
        try {
            $studentName = $concern->first_name . ' ' . $concern->last_name;
            $adminRemarks = $request->remarks;
            $type = $concern->concern_type;

            Mail::raw("Dear $studentName,\n\nYour concern regarding '$type' has been officially COMPLETED by our Staff.\n\nResolution Remarks: $adminRemarks\n\nThank you.", function ($message) use ($concern) {
                $message->to($concern->email)
                        ->subject('Concern Resolved - Staff Panel');
            });
        } catch (\Exception $e) {
            Log::error("Staff Mail Error: " . $e->getMessage());
        }

        return response()->json(['success' => true]);
    }
}