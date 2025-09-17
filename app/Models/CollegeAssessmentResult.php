<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeAssessmentResult extends Model
{
    use HasFactory;

    protected $table = 'college_shs_assessment_result';

    protected $fillable = [
        'assessment_id',
        'full_name',
        'age',
        'email',
        'recommended_course',             // 👈 NEW
        'recommended_course_description', // 👈 NEW
        'confidence_score',               // 👈 NEW
        'narrative',                      // 👈 NEW (optional)
    ];
}