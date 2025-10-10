<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollegeStatus;
use App\Models\ShsStatus;
use App\Models\CollegeEnrollmentPreference;
use App\Models\CollegeStudent;
use App\Models\CollegeStudentType;
use App\Models\CollegeBranch;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for College
        $collegePending = CollegeStatus::where('info_status', 'Pending')->count();
        $collegeValidated = CollegeStatus::where('info_status', 'Validated')->count();
        $collegeCancelled = CollegeStatus::where('info_status', 'Cancelled')->count();
        $collegeReEvaluate = CollegeStatus::where('info_status', 'Re-Evaluate')->count();

        // Get counts for SHS
        $shsPending = ShsStatus::where('info_status', 'Pending')->count();
        $shsValidated = ShsStatus::where('info_status', 'Validated')->count();
        $shsCancelled = ShsStatus::where('info_status', 'Cancelled')->count();
        $shsReEvaluate = ShsStatus::where('info_status', 'Re-Evaluate')->count();

        // Total counts for status
        $totalPending = $collegePending + $shsPending;
        $totalValidated = $collegeValidated + $shsValidated;
        $totalCancelled = $collegeCancelled + $shsCancelled;
        $totalReEvaluate = $collegeReEvaluate + $shsReEvaluate;

        $totalStudents = $totalPending + $totalValidated + $totalCancelled + $totalReEvaluate;

        // Percentages for status
        $pendingPercentage = $totalStudents > 0 ? round(($totalPending / $totalStudents) * 100, 1) : 0;
        $validatedPercentage = $totalStudents > 0 ? round(($totalValidated / $totalStudents) * 100, 1) : 0;
        $cancelledPercentage = $totalStudents > 0 ? round(($totalCancelled / $totalStudents) * 100, 1) : 0;
        $reEvaluatePercentage = $totalStudents > 0 ? round(($totalReEvaluate / $totalStudents) * 100, 1) : 0;

        // Campus counts (assuming branch names 'Main Campus' and 'Bulacan')
        $mainCampusCollege = CollegeEnrollmentPreference::whereHas('branch', function($q) {
            $q->where('branch_name', 'like', '%Main%');
        })->count();
        $bulacanCollege = CollegeEnrollmentPreference::whereHas('branch', function($q) {
            $q->where('branch_name', 'like', '%Bulacan%');
        })->count();

        // For SHS, assuming similar ShsBranch model
        $mainCampusShs = 0; // Placeholder - adjust if ShsBranch exists
        $bulacanShs = 0; // Placeholder - adjust if ShsBranch exists

        $totalMainCampus = $mainCampusCollege + $mainCampusShs;
        $totalBulacan = $bulacanCollege + $bulacanShs;
        $totalCampus = $totalMainCampus + $totalBulacan;

        $mainCampusPercentage = $totalCampus > 0 ? round(($totalMainCampus / $totalCampus) * 100, 1) : 0;
        $bulacanPercentage = $totalCampus > 0 ? round(($totalBulacan / $totalCampus) * 100, 1) : 0;

        // Student type counts (New Regular, Transferee, Returnee)
        $newRegularCollege = CollegeStudent::whereHas('type', function($q) {
            $q->where('type_name', 'New Regular');
        })->count();
        $transfereeCollege = CollegeStudent::whereHas('type', function($q) {
            $q->where('type_name', 'Transferee');
        })->count();
        $returneeCollege = CollegeStudent::whereHas('type', function($q) {
            $q->where('type_name', 'Returnee');
        })->count();

        // For SHS, assuming ShsStudentType
        $newRegularShs = 0; // Placeholder
        $transfereeShs = 0; // Placeholder
        $returneeShs = 0; // Placeholder

        $totalNewRegular = $newRegularCollege + $newRegularShs;
        $totalTransferee = $transfereeCollege + $transfereeShs;
        $totalReturnee = $returneeCollege + $returneeShs;
        $totalTypes = $totalNewRegular + $totalTransferee + $totalReturnee;

        $newRegularPercentage = $totalTypes > 0 ? round(($totalNewRegular / $totalTypes) * 100, 1) : 0;
        $transfereePercentage = $totalTypes > 0 ? round(($totalTransferee / $totalTypes) * 100, 1) : 0;
        $returneePercentage = $totalTypes > 0 ? round(($totalReturnee / $totalTypes) * 100, 1) : 0;

        return view('dashboard', compact(
            'pendingPercentage',
            'validatedPercentage',
            'cancelledPercentage',
            'reEvaluatePercentage',
            'totalStudents',
            'mainCampusPercentage',
            'bulacanPercentage',
            'newRegularPercentage',
            'transfereePercentage',
            'returneePercentage'
        ));
    }
}
