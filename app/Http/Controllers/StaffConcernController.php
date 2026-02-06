<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern;

class StaffConcernController extends Controller
{
    public function index()
    {
        // Kinukuha ang lahat ng concerns, latest first
        $concerns = Concern::orderBy('submission_date', 'desc')->get();
        return view('modules.staff.concerns', compact('concerns'));
    }
    
    public function show($id)
    {
        $concern = Concern::findOrFail($id);
        return response()->json($concern);
    }
}