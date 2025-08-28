<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsCourse extends Model
{
    protected $table = 'shs_courses';
    protected $primaryKey = 'course_id';
    public $timestamps = false;

    public function branch()
    {
        return $this->belongsTo(ShsBranch::class, 'branch_id');
    }
}