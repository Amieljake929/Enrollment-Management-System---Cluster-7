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
        try {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'age' => 'required|integer|min:15|max:99',
                'email' => 'required|email',
            ]);

            // ✅ SAFE: Only consider AT-prefixed records
            $lastRecord = CollegeAssessmentResult::where('assessment_id', 'LIKE', 'AT%')
                ->orderBy('id', 'desc')
                ->first();

            if ($lastRecord && preg_match('/^AT(\d{4})$/', $lastRecord->assessment_id, $matches)) {
                $nextId = (int)$matches[1] + 1;
            } else {
                $nextId = 1;
            }

            $assessmentId = 'AT' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

            $result = CollegeAssessmentResult::create([
                'assessment_id' => $assessmentId,
                'full_name' => $request->full_name,
                'age' => $request->age,
                'email' => $request->email,
            ]);

            session(['college_assessment_data' => [
                'name' => $request->full_name,
                'assessment_id' => $assessmentId
            ]]);

            return response()->json([
                'success' => true,
                'message' => 'Information submitted successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('College Info Submit Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Submission failed. Please try again.'
            ], 500);
        }
    }

    public function showWelcome()
    {
        $data = session('college_assessment_data');
        if (!$data) {
            return redirect()->route('college.info.form');
        }
        return view('website.CollegeWelcome', compact('data'));
    }

    // ===== SHS METHODS (already working) =====

    public function showShsInfoForm()
    {
        return view('website.ShsInfoTest');
    }

    public function submitShsInfo(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:99',
            'email' => 'required|email',
        ]);

        $lastRecord = CollegeAssessmentResult::where('assessment_id', 'LIKE', 'SH%')->latest()->first();
        $nextId = $lastRecord ? (int) substr($lastRecord->assessment_id, 2) + 1 : 1;
        $assessmentId = 'SH' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $result = CollegeAssessmentResult::create([
            'assessment_id' => $assessmentId,
            'full_name' => $request->full_name,
            'age' => $request->age,
            'email' => $request->email,
        ]);

        session(['shs_assessment_data' => [
            'name' => $request->full_name,
            'assessment_id' => $assessmentId
        ]]);

        return response()->json([
            'success' => true,
            'message' => 'SHS information submitted successfully!'
        ]);
    }

    public function showShsWelcome()
    {
        $data = session('shs_assessment_data');
        if (!$data) {
            return redirect()->route('shs.info.form');
        }
        return view('website.ShsWelcome', compact('data'));
    }
}