<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CollegeStudentController;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\ShsStudentApiController; 
use App\Http\Middleware\CheckApiKey;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public route (walang API key required base sa dati mong code)
Route::get('/college-students', [CollegeStudentController::class, 'index']);

// Protected Routes (Kailangan ng x-api-key sa Header)
Route::middleware([CheckApiKey::class])->group(function () {
    
    /**
     * COLLEGE STUDENT ROUTES
     */
    // Kunin ang info ng isang specific student (Dapat Paid)
    Route::get('/student-info/{id}', [StudentApiController::class, 'getStudentData']);
    
    // Listahan ng lahat ng Paid College Students
    Route::get('/students/all-paid', [StudentApiController::class, 'getAllPaidStudents']);
    
    // Listahan ng lahat ng Hindi Pa Bayad (College)
    Route::get('/students/not-paid', [StudentApiController::class, 'getNotPaidStudents']);
    
    // Update Payment Status at Auto-generate Student ID (College)
    Route::post('/student/update-payment', [StudentApiController::class, 'updatePaymentStatus']);


    /**
     * SENIOR HIGH SCHOOL (SHS) ROUTES
     */
    // Kunin ang info ng isang specific SHS student (Dapat Paid)
    Route::get('/shs-student-info/{id}', [ShsStudentApiController::class, 'getStudentData']);
    
    // Listahan ng lahat ng Paid SHS Students
    Route::get('/shs-students/all-paid', [ShsStudentApiController::class, 'getAllPaidShsStudents']);
    
    // Listahan ng lahat ng Hindi Pa Bayad (SHS)
    Route::get('/shs-students/not-paid', [ShsStudentApiController::class, 'getNotPaidShsStudents']);
    
    // Update Payment Status at Auto-generate Student ID (SHS)
    Route::post('/shs-student/update-payment', [ShsStudentApiController::class, 'updateShsPaymentStatus']);
    
});