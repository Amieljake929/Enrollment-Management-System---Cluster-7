<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsStudentType extends Model
{
    protected $table = 'shs_student_types';
    protected $primaryKey = 'type_id';
    public $timestamps = false;
}