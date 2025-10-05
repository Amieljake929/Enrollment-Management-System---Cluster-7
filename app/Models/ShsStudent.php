<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsStudent extends Model
{
    protected $table = 'shs_students';
    protected $primaryKey = 'student_id';
    public $timestamps = true;

    protected $fillable = [
    'type_id', 'first_name', 'middle_name', 'last_name', 'extension_name',
    'civil_status', 'gender', 'dob', 'place_of_birth', 'nationality',
    'lrn', 'previous_student_id', 'current_address', 'city_municipality',
    'province', 'region_id', 'zip_code', 'religion', 'email',
    'contact_number', 'social_media','indigenous_id',
    'disability_id'
];

    public function studentType()
    {
        return $this->belongsTo(ShsStudentType::class, 'type_id', 'type_id');
    }

    public function parentInfo()
    {
        return $this->hasOne(ShsParentInfo::class, 'student_id');
    }

    public function guardian()
    {
        return $this->hasOne(ShsGuardian::class, 'student_id');
    }

    public function enrollmentPreference()
    {
        return $this->hasOne(ShsEnrollmentPreference::class, 'student_id');
    }

    public function educationalBackground()
    {
        return $this->hasOne(ShsEducationalBackground::class, 'student_id');
    }

    public function documents()
    {
        return $this->hasMany(ShsUploadedDocument::class, 'student_id');
    }
    public function enrolleeNumber()
{
    return $this->hasOne(ShsEnrolleeNumber::class, 'student_id', 'student_id');
}
public function indigenous()
{
    return $this->belongsTo(CollegeShsIndigenous::class, 'indigenous_id');
}

public function disability()
{
    return $this->belongsTo(CollegeShsDisability::class, 'disability_id');
}
public function status()
{
    return $this->hasOne(ShsStatus::class, 'student_id', 'student_id');
}

}