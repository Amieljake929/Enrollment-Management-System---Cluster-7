<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollegeStatus;
use App\Models\ShsStatus;
use App\Models\CollegeEnrollmentPreference;
use App\Models\ShsEnrollmentPreference;
use App\Models\CollegeStudent;
use App\Models\CollegeStudentType;
use App\Models\CollegeBranch;
use App\Models\CollegeCourse;
use App\Models\ShsCourse;
use Carbon\Carbon;

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

        // Counts for status (no percentages)
        $pendingCount = $totalPending;
        $waitingListCount = $totalValidated; // Assuming Validated = Waiting List
        $cancelledCount = $totalCancelled;

        // Campus counts (assuming branch names 'Main Campus' and 'Bulacan')
        $mainCampusCollege = CollegeEnrollmentPreference::whereHas('branch', function($q) {
            $q->where('branch_name', 'like', '%Main%');
        })->count();
        $bulacanCollege = CollegeEnrollmentPreference::whereHas('branch', function($q) {
            $q->where('branch_name', 'like', '%Bulacan%');
        })->count();

        // For SHS branches
        $mainCampusShs = ShsEnrollmentPreference::whereHas('branch', function($q) {
            $q->where('branch_name', 'like', '%Main%');
        })->count();
        $bulacanShs = ShsEnrollmentPreference::whereHas('branch', function($q) {
            $q->where('branch_name', 'like', '%Bulacan%');
        })->count();

        $totalMainCampus = $mainCampusCollege + $mainCampusShs;
        $totalBulacan = $bulacanCollege + $bulacanShs;
        $totalCampus = $totalMainCampus + $totalBulacan;

        $mainCampusPercentage = $totalCampus > 0 ? round(($totalMainCampus / $totalCampus) * 100, 1) : 0;
        $bulacanPercentage = $totalCampus > 0 ? round(($totalBulacan / $totalCampus) * 100, 1) : 0;

        // Branch counts for cards
        $mainBranchCount = $totalMainCampus;
        $bulacanBranchCount = $totalBulacan;

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

        // Weekly trend data for the past 7 days
        $dates = [];
        $pendingWeekly = [];
        $waitingListWeekly = [];
        $cancelledWeekly = [];
        $mainBranchWeekly = [];

        $startDate = Carbon::now()->subDays(6)->format('M d');
        $endDate = Carbon::now()->format('M d');
        $dateRange = $startDate . ' - ' . $endDate;

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $dates[] = Carbon::now()->subDays($i)->format('M d');

            // Pending counts for the day
            $collegePendingDay = CollegeStatus::where('info_status', 'Pending')
                ->whereDate('created_at', $date)
                ->count();
            $shsPendingDay = ShsStatus::where('info_status', 'Pending')
                ->whereDate('created_at', $date)
                ->count();
            $pendingWeekly[] = $collegePendingDay + $shsPendingDay;

            // Waiting List (Validated) counts for the day
            $collegeWaitingDay = CollegeStatus::where('info_status', 'Validated')
                ->whereDate('created_at', $date)
                ->count();
            $shsWaitingDay = ShsStatus::where('info_status', 'Validated')
                ->whereDate('created_at', $date)
                ->count();
            $waitingListWeekly[] = $collegeWaitingDay + $shsWaitingDay;

            // Cancelled counts for the day
            $collegeCancelledDay = CollegeStatus::where('info_status', 'Cancelled')
                ->whereDate('created_at', $date)
                ->count();
            $shsCancelledDay = ShsStatus::where('info_status', 'Cancelled')
                ->whereDate('created_at', $date)
                ->count();
            $cancelledWeekly[] = $collegeCancelledDay + $shsCancelledDay;

            // Main Branch counts for the day
            $collegeMainDay = CollegeEnrollmentPreference::whereHas('branch', function($q) {
                $q->where('branch_name', 'like', '%Main%');
            })->whereDate('created_at', $date)->count();
            $shsMainDay = ShsEnrollmentPreference::whereHas('branch', function($q) {
                $q->where('branch_name', 'like', '%Main%');
            })->whereDate('created_at', $date)->count();
            $mainBranchWeekly[] = $collegeMainDay + $shsMainDay;
        }

        // Get course counts for College, sorted by popularity (highest first)
        $collegeCourses = CollegeEnrollmentPreference::selectRaw('course_id, COUNT(*) as count')
            ->groupBy('course_id')
            ->with('course')
            ->orderBy('count', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->course->course_name ?? 'Unknown',
                    'count' => $item->count
                ];
            });

        // Get strand counts for SHS, sorted by popularity (highest first)
        $shsStrands = ShsEnrollmentPreference::selectRaw('course_id, COUNT(*) as count')
            ->groupBy('course_id')
            ->with('course')
            ->orderBy('count', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->course->course_name ?? 'Unknown',
                    'count' => $item->count
                ];
            });

        return view('dashboard', compact(
            'pendingCount',
            'waitingListCount',
            'cancelledCount',
            'totalStudents',
            'mainBranchCount',
            'bulacanBranchCount',
            'newRegularPercentage',
            'transfereePercentage',
            'returneePercentage',
            'dates',
            'pendingWeekly',
            'waitingListWeekly',
            'cancelledWeekly',
            'mainBranchWeekly',
            'dateRange',
            'collegeCourses',
            'shsStrands'
        ));
    }
}
