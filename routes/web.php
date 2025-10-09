<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CollegeQuizController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ShsEnrollmentController; // 👈 Added: SHS Enrollment Controller
use App\Http\Controllers\PendingAdmissionController;
use App\Http\Controllers\WaitingController;
use App\Http\Controllers\ReEvaluationController;
use App\Http\Controllers\CancelledController;
use App\Http\Controllers\CollegeAssessmentController;
use App\Http\Controllers\ConcernController;





// ===================================================
// === 🏠 Landing Pages (Public) ===
// ===================================================

// Homepage: one.blade.php
Route::get('/', function () {
    return view('website.one');
})->name('one');

// Second page: two.blade.php
Route::get('/two', function () {
    return view('website.two');
})->name('two');

// CONCERN SUBMISSION
Route::post('/concerns', [ConcernController::class, 'store'])->name('concerns.store');

// ===================================================
// === 📝 Assessment & Enrollment Modals ===
// ===================================================

// 🔹 Assessment Modal Pages
Route::get('/college-quiz', function () {
    return view('website.CollegeQuiz');
})->name('college.quiz');

Route::get('/quiz', [QuizController::class, 'showShsQuiz'])->name('quiz.show');

// ✅ New: College Info Test Page
Route::get('/college-info-test', function () {
    return view('website.CollegeInfoTest');
})->name('college.info.test');

Route::get('/shs-info-test', function () {
    return view('website.ShsInfoTest');
})->name('shs.info.test');

// 🔹 Enrollment Modal Pages
// ✅ Use Controller to pass required data
Route::get('/college-enrollment', [EnrollmentController::class, 'showForm'])
    ->name('college.enrollment');

Route::get('/shs-enrollment', function () {
    return view('website.ShsEnrollment');
})->name('shs.enrollment');

// 🔹 Main Enrollment Page
Route::get('/enrollment', function () {
    return view('website.Enrollment');
})->name('enrollment');

// ===================================================
// === 🧠 Quiz Assessment Routes ===
// ===================================================

Route::get('/quiz', [QuizController::class, 'showQuiz'])->name('quiz.show');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');

Route::get('/college/quiz', [CollegeQuizController::class, 'showQuiz'])->name('college.quiz.show');
Route::post('/college/quiz', [CollegeQuizController::class, 'submit'])->name('college.quiz.submit');

// NEW ROUTES FOR COLLEGE ASSESSMENT FLOW (using new controller)
Route::get('/college/info', [CollegeAssessmentController::class, 'showInfoForm'])->name('college.info.form');
Route::post('/college/info/submit', [CollegeAssessmentController::class, 'submitInfo'])->name('college.info.submit');
Route::get('/college/welcome', [CollegeAssessmentController::class, 'showWelcome'])->name('college.welcome');
// SHS Assessment Flow
Route::get('/shs/info', [CollegeAssessmentController::class, 'showShsInfoForm'])->name('shs.info.form');
Route::post('/shs/info/submit', [CollegeAssessmentController::class, 'submitShsInfo'])->name('shs.info.submit');
Route::get('/shs/welcome', [CollegeAssessmentController::class, 'showShsWelcome'])->name('shs.welcome');

// Add this AFTER existing College Assessment Flow routes
Route::post('/college/interests/submit', [CollegeQuizController::class, 'submitInterests'])->name('college.interests.submit');
// SHS Interest Submission (after SHS Welcome route)
Route::post('/shs/interests/submit', [QuizController::class, 'submitInterests'])->name('shs.interests.submit');


// ===================================================
// === 📝 COLLEGE ENROLLMENT ROUTES ===
// ===================================================

// Show the enrollment form
Route::get('/college-enrollment/form', [EnrollmentController::class, 'showForm'])
    ->name('enrollment.form');

// Handle form submission
Route::post('/college-enrollment/submit', [EnrollmentController::class, 'submit'])
    ->name('enrollment.submit');

// Success page after submission
Route::get('/college-enrollment/success', [EnrollmentController::class, 'success'])
    ->name('enrollment.success');

// ===================================================
// === 📚 SHS ENROLLMENT ROUTES ===
// ===================================================
// routes/web.php
Route::prefix('shs')->name('shs.')->middleware('web')->group(function () {
    Route::get('/enrollment', [ShsEnrollmentController::class, 'showForm'])->name('enrollment');
    Route::post('/enrollment/submit', [ShsEnrollmentController::class, 'submit'])->name('enrollment.submit');
    Route::get('/enrollment/success', [ShsEnrollmentController::class, 'success'])->name('enrollment.success');
});

// ===================================================
// === 🔐 Auth & Dashboard (Protected) ===
// ===================================================

// Login & MFA
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/mfa', [LoginController::class, 'showMfaForm'])->name('mfa.form');
Route::post('/mfa', [LoginController::class, 'verifyMfa'])->name('mfa.verify');

// Check session for polling
use Illuminate\Support\Facades\Session;

Route::get('/check-session', function() {
    $authenticated = Auth::check();

    // Example logic to detect if session invalidated due to login on another device
    // This requires you to implement session tracking logic to set a flag in session or cache
    $loggedOutDueToOtherDevice = Session::get('logged_out_due_to_other_device', false);

    return response()->json([
        'authenticated' => $authenticated,
        'logged_out_due_to_other_device' => $loggedOutDueToOtherDevice,
    ]);
});

// OTP Verification
Route::get('/verify-otp', [RegisteredUserController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [RegisteredUserController::class, 'verifyOtp'])->name('verify.otp.post');

// Dashboard & Documents
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Staff OIC Dashboard
Route::get('/dashboard-staff', function () {
    return view('DashboardStaff');
})->middleware(['auth', 'verified'])->name('dashboard.staff'); // ⚠️ Removed 'verified' for now


////////////////////
//                //
// MODULES ROUTES //
//                //
////////////////////

Route::prefix('modules')->middleware(['auth'])->group(function () {

    // Pending Admissions
    Route::get('/pending/college', [PendingAdmissionController::class, 'index'])->name('modules.pending.college');
    // ✅ Ilagay mo dito ang PDF route BEFORE the {id} route
    Route::get('/pending/college/download-pdf', [PendingAdmissionController::class, 'downloadPdf'])
        ->name('modules.pending.college.download.pdf');

    // ✅ SHS PDF (ADD THIS)
    Route::get('/pending/shs/download-pdf', [PendingAdmissionController::class, 'downloadShsPdf'])
        ->name('modules.pending.shs.download.pdf');
        
    Route::get('/pending/college/{id}', [PendingAdmissionController::class, 'show'])->name('modules.pending.college.show');
    Route::get('/pending/shs', [PendingAdmissionController::class, 'shsIndex'])->name('modules.pending.shs');
    Route::delete('/pending/college/{id}', [PendingAdmissionController::class, 'destroy'])->name('modules.pending.college.destroy');

    // SHS Show & Delete
    Route::get('/pending/shs/{id}', [PendingAdmissionController::class, 'showShs'])->name('modules.pending.shs.show');
    Route::delete('/pending/shs/{id}', [PendingAdmissionController::class, 'destroyShs'])->name('modules.pending.shs.destroy');

    // BUTTONS FOR PENDING COLLEGE
     Route::post('/pending/college/{id}/validate', [PendingAdmissionController::class, 'validate'])->name('modules.pending.college.validate');
     Route::post('/pending/college/{id}/cancel', [PendingAdmissionController::class, 'cancel'])->name('modules.pending.college.cancel');
     Route::post('/pending/college/{id}/reevaluate', [PendingAdmissionController::class, 'reevaluate'])->name('modules.pending.college.reevaluate');

    // Inside Route::prefix('modules')->middleware(['auth'])->group(function () { ... })

    // BUTTONS FOR PENDING SHS
     Route::post('/pending/shs/{id}/validate', [PendingAdmissionController::class, 'validateShs'])->name('modules.pending.shs.validate');
     Route::post('/pending/shs/{id}/cancel', [PendingAdmissionController::class, 'cancelShs'])->name('modules.pending.shs.cancel');
     Route::post('/pending/shs/{id}/reevaluate', [PendingAdmissionController::class, 'reevaluateShs'])->name('modules.pending.shs.reevaluate');

    // Waiting List
     Route::get('/waiting/college', [WaitingController::class, 'index'])->name('modules.waiting.college');
     Route::get('/waiting/shs', [WaitingController::class, 'shsIndex'])->name('modules.waiting.shs');
    
   // Update payment status (auto-generate student ID number when Paid)
     Route::post('/college/payment/update/{studentId}', [WaitingController::class, 'updateCollegePaymentStatus'])
    ->name('college.payment.update');

     Route::post('/shs/payment/update/{studentId}', [WaitingController::class, 'updateShsPaymentStatus'])
    ->name('shs.payment.update');


    // Student Records
    Route::get('/records/college', function () {
        if (request()->ajax()) {
            return view('modules.recordsCollege')->render();
        }
        return view('modules.recordsCollege');
    })->name('modules.records.college');

    Route::get('/records/shs', function () {
        if (request()->ajax()) {
            return view('modules.recordsShs')->render();
        }
        return view('modules.recordsShs');
    })->name('modules.records.shs');

     // ✅ CANCELLED ADMISSIONS - COLLEGE
     Route::get('/cancelled/college', [CancelledController::class, 'index'])->name('modules.cancelled.college');
     Route::get('/cancelled/college/{id}', [CancelledController::class, 'show'])->name('modules.cancelled.college.show');

     // ✅ CANCELLED ADMISSIONS - SHS
     Route::get('/cancelled/shs', [CancelledController::class, 'shsIndex'])->name('modules.cancelled.shs');
     Route::get('/cancelled/shs/{id}', [CancelledController::class, 'showShs'])->name('modules.cancelled.shs.show');


     // RE-EVALUATION COLLEGE
     Route::get('/reevaluation/college', [ReEvaluationController::class, 'index'])
     ->name('modules.reevaluation.college');

     // RE-EVALUATION SHS
     Route::get('/reevaluation/shs', [ReEvaluationController::class, 'shsIndex'])
    ->name('modules.reevaluation.shs');

     // Concerns Route
     // Concerns Route
     Route::get('/concerns', [ConcernController::class, 'index'])->name('modules.concerns');
     Route::get('/concerns/{id}', [ConcernController::class, 'show'])->name('modules.concerns.show'); // 👈 NEW


    // Parents Notification
    Route::get('/parents/college', function () {
        if (request()->ajax()) {
            return view('modules.parentsCollege')->render();
        }
        return view('modules.parentsCollege');
    })->name('modules.parents.college');

    Route::get('/parents/shs', function () {
        if (request()->ajax()) {
            return view('modules.parentsShs')->render();
        }
        return view('modules.parentsShs');
    })->name('modules.parents.shs');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Terms Agreement
Route::post('/user/agree-terms', [App\Http\Controllers\TermsController::class, 'agreeTerms'])->name('user.agree.terms');
    
});

// Temporary route for the new assessment test page
Route::get('/assessment-test', function () {
    return view('website.AssessmentTest');
})->name('assessment.test');

// ===================================================
// === 🛑 Laravel Auth (logout, register, etc.) ===
// ===================================================
require __DIR__.'/auth.php';

// ===================================================
// === 🔐 OVERRIDE: Logout Redirect to /login ===
// ===================================================
Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login')->with('status', 'You have been logged out.');
})->name('logout');

// Add GET route for /logout to gracefully handle GET requests
Route::get('/logout', function () {
    return redirect('/login')->with('status', 'You have been logged out.');
});
