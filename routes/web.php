<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CollegeQuizController;
use App\Http\Controllers\EnrollmentController; // 👈 Added: Enrollment Controller

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

// ===================================================
// === 📝 Assessment & Enrollment Modals ===
// ===================================================

// 🔹 Assessment Modal Pages
Route::get('/college-quiz', function () {
    return view('website.CollegeQuiz');
})->name('college.quiz');

Route::get('/shs-quiz', function () {
    return view('website.ShsQuiz');
})->name('shs.quiz');

// 🔹 Enrollment Modal Pages
Route::get('/college-enrollment', function () {
    return view('website.CollegeEnrollment');
})->name('college.enrollment');

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
// === 🔐 Auth & Dashboard (Protected) ===
// ===================================================

// Login & MFA
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/mfa', [LoginController::class, 'showMfaForm'])->name('mfa.form');
Route::post('/mfa', [LoginController::class, 'verifyMfa'])->name('mfa.verify');

// OTP Verification
Route::get('/verify-otp', [RegisteredUserController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [RegisteredUserController::class, 'verifyOtp'])->name('verify.otp.post');

// Dashboard & Documents
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/documents', function () {
    return view('documents');
})->middleware(['auth', 'verified'])->name('documents');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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