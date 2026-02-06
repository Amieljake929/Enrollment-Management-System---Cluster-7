<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail; // IMPORT MAIL FACADE
use App\Models\Concern;
use App\Mail\StudentConcernMail; // IMPORT YOUR MAILABLE CLASS

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

        // 1. Save to Database
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

        // 2. Send Email Notification to Bestlink
        try {
            Mail::to('bestlinkcollegeofph@gmail.com')->send(new StudentConcernMail($concern));
        } catch (\Exception $e) {
            // Ni-log natin ang error pero hindi natin i-stop ang response para alam ni student na saved ang concern niya
            \Log::error("Mail Sending Failed: " . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your concern has been submitted successfully. We will get back to you soon.'
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
        return response()->json($concern);
    }
}