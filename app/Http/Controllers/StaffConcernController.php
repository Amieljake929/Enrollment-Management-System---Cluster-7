<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Concern;

class StaffConcernController extends Controller
{
    public function index()
    {
        $concerns = Concern::orderBy('submission_date', 'desc')->get();
        return view('modules.staff.Concerns', compact('concerns'));
    }
    
    public function show($id)
    {
        $concern = Concern::findOrFail($id);
        return response()->json($concern);
    }
}
