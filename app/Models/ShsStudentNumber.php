<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShsStudentNumber extends Model
{
    use HasFactory;

    protected $table = 'shs_student_number';
    protected $fillable = ['student_id', 'student_id_number'];

    public function student()
    {
        return $this->belongsTo(ShsStudent::class, 'student_id', 'student_id');
    }
}
