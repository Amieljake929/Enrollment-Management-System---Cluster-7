<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeEnrollmentPreference extends Model
{
    protected $table = 'college_enrollment_preferences';
    protected $primaryKey = 'preference_id';
    public $timestamps = false;

    protected $fillable = ['student_id', 'branch_id', 'course_id', 'level_id'];

    // Add these relationships
    public function course()
    {
        return $this->belongsTo(CollegeCourse::class, 'course_id');
    }

    public function branch()
    {
        return $this->belongsTo(CollegeBranch::class, 'branch_id');
    }

    public function level()
    {
        return $this->belongsTo(CollegeYearLevel::class, 'level_id');
    }
}