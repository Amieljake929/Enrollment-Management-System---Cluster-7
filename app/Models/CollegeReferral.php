<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeReferral extends Model
{
    use HasFactory;

    protected $table = 'college_referral';

    protected $fillable = [
        'student_id',
        'referral_source',
        'referral_name',
        'referral_relation'
    ];

    // Optional: Define relationship to student
    public function student()
    {
        return $this->belongsTo(CollegeStudent::class, 'student_id');
    }
}