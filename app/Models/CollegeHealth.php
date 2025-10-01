<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeHealth extends Model
{
    use HasFactory;

    protected $table = 'college_health_info';

    protected $fillable = [
        'student_id',
        'condition_type',
        'condition',
        'weight_kg',
        'height_cm'
    ];

    // Optional: Define relationship to student
    public function student()
    {
        return $this->belongsTo(CollegeStudent::class, 'student_id');
    }
}