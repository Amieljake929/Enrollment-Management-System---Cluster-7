<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsParentInfo extends Model
{
    protected $table = 'shs_parent_info';
    protected $primaryKey = 'parent_id';
    public $timestamps = false;

    protected $fillable = [
    'student_id', 'mother_first_name', 'mother_middle_name', 'mother_last_name',
    'mother_occupation', 'mother_contact', 'mother_email',
    'father_first_name', 'father_middle_name', 'father_last_name',
    'father_occupation', 'father_contact', 'father_email'
];
}