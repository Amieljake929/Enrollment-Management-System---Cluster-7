<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeStudentType extends Model
{
    protected $table = 'college_student_types';
    protected $primaryKey = 'type_id';
    public $timestamps = false;
}
