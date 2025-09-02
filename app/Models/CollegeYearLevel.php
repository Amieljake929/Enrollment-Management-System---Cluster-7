<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeYearLevel extends Model
{
    protected $table = 'college_year_levels';
    protected $primaryKey = 'level_id';
    public $timestamps = false;

    protected $fillable = ['level_name', 'description'];

    // Relationship to preferences
    public function preferences()
    {
        return $this->hasMany(CollegeEnrollmentPreference::class, 'level_id');
    }
}