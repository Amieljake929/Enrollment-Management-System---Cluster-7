<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollegeAssessmentResult;

class CollegeAssessmentController extends Controller
{
    public function showInfoForm()
    {
        return view('website.CollegeInfoTest');
    }

    public function submitInfo(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:99',
            'email' => 'required|email',
        ]);

        // Generate unique ID: AT0001, AT0002, etc.
        $lastRecord = CollegeAssessmentResult::latest()->first();
        $nextId = $lastRecord ? (int) substr($lastRecord->assessment_id, 2) + 1 : 1;
        $assessmentId = 'AT' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $result = CollegeAssessmentResult::create([
            'assessment_id' => $assessmentId,
            'full_name' => $request->full_name,
            'age' => $request->age,
            'email' => $request->email,
        ]);

        // Store in session for welcome page
        session(['college_assessment_data' => [
            'name' => $request->full_name,
            'assessment_id' => $assessmentId
        ]]);

        return response()->json([
            'success' => true,
            'message' => 'Information submitted successfully!'
        ]);
    }

    public function showWelcome()
    {
        $data = session('college_assessment_data');

        if (!$data) {
            return redirect()->route('college.info.form');
        }

        return view('website.CollegeWelcome', compact('data'));
    }
}