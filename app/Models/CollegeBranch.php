<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeBranch extends Model
{
    protected $table = 'college_branches';
    protected $primaryKey = 'branch_id';
    public $timestamps = false;

    protected $fillable = ['branch_name', 'address', 'contact_number'];

    // Relationship to preferences
    public function preferences()
    {
        return $this->hasMany(CollegeEnrollmentPreference::class, 'branch_id');
    }
}