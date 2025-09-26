<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CollegeStudentController; // <-- importante!

Route::get('/college-students', [CollegeStudentController::class, 'index']);