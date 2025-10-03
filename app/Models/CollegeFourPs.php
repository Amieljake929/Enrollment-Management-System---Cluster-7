<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeFourPs extends Model
{
    protected $table = 'college_four_ps';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['student_id'];

    public function student()
    {
        return $this->belongsTo(CollegeStudent::class, 'student_id', 'student_id');
    }
}