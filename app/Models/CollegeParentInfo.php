<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeParentInfo extends Model
{
    protected $table = 'college_parents_info';
    protected $primaryKey = 'parent_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id', 'parent_type', 'first_name', 'middle_name', 'last_name',
        'occupation', 'contact_number', 'email'
    ];
}
