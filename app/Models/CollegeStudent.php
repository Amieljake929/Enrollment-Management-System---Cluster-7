<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeStudent extends Model
{
    protected $table = 'college_students';
    protected $primaryKey = 'student_id';
    public $timestamps = true;

    protected $fillable = [
        'type_id', 'first_name', 'middle_name', 'last_name', 'extension_name',
        'civil_status', 'gender', 'dob', 'place_of_birth', 'nationality',
        'previous_student_id', 'contact_number', 'email', 'social_media',
        'religion', 'current_address', 'city_municipality', 'province',
        'zip_code', 'region_id','indigenous_id',
    'disability_id'
    ];

    // Relationships
    public function type()
    {
        return $this->belongsTo(CollegeStudentType::class, 'type_id');
    }

    public function parentInfo()
{
    return $this->hasMany(CollegeParentInfo::class, 'student_id', 'student_id');
}

    public function guardian()
    {
        return $this->hasOne(CollegeGuardian::class, 'student_id');
    }

    public function preference()
    {
        return $this->hasOne(CollegeEnrollmentPreference::class, 'student_id');
    }

    public function educationalBackground()
    {
        return $this->hasOne(CollegeEducationalBackground::class, 'student_id');
    }

    public function documents()
    {
        return $this->hasMany(CollegeUploadedDocument::class, 'student_id');
    }
    public function enrolleeNumber()
{
    return $this->hasOne(CollegeEnrolleeNumber::class, 'student_id', 'student_id');
}
public function indigenous()
{
    return $this->belongsTo(CollegeShsIndigenous::class, 'indigenous_id');
}

public function disability()
{
    return $this->belongsTo(CollegeShsDisability::class, 'disability_id');
}
public function fourPs()
{
    return $this->hasOne(CollegeFourPs::class, 'student_id', 'student_id');
}
public function status()
{
    return $this->hasOne(CollegeStatus::class, 'student_id', 'student_id');
}

public function studentNumber()
{
    return $this->hasOne(CollegeStudentNumber::class, 'student_id', 'student_id');
}

}