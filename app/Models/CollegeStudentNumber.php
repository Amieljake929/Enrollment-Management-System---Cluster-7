<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeStudentNumber extends Model
{
    use HasFactory;

    protected $table = 'college_student_number';
    protected $primaryKey = 'id';
    protected $fillable = ['student_id', 'student_id_number'];

    public function student()
    {
        return $this->belongsTo(CollegeStudent::class, 'student_id', 'student_id');
    }
}
