<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsEnrollmentPreference extends Model
{
    protected $table = 'shs_enrollment_preferences';
    protected $primaryKey = 'preference_id';
    public $timestamps = false;

    protected $fillable = ['student_id', 'branch_id', 'course_id', 'level_id'];

    // ✅ IDAGDAG ANG ITO (hindi binabago ang anuman)
    public function course()
    {
        return $this->belongsTo(ShsCourse::class, 'course_id');
    }

    public function branch()
    {
        return $this->belongsTo(ShsBranch::class, 'branch_id');
    }

    public function level()
    {
        return $this->belongsTo(ShsYearLevel::class, 'level_id');
    }
}