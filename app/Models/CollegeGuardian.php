<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeGuardian extends Model
{
    protected $table = 'college_guardians';
    protected $primaryKey = 'guardian_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id', 'first_name', 'middle_name', 'last_name',
        'dob', 'contact_number', 'email'
    ];
}