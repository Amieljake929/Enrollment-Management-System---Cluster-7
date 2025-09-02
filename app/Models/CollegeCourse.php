<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeCourse extends Model
{
    protected $table = 'college_courses';
    protected $primaryKey = 'course_id';
    public $timestamps = false;

    protected $fillable = ['course_name', 'description', 'units'];

    // Relationship to preferences
    public function preferences()
    {
        return $this->hasMany(CollegeEnrollmentPreference::class, 'course_id');
    }
}