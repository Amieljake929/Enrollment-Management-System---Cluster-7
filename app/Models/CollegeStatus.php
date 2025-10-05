<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeStatus extends Model
{
    use HasFactory;

    protected $table = 'college_status';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'info_status',
        'payment',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(CollegeStudent::class, 'student_id', 'student_id');
    }
}
