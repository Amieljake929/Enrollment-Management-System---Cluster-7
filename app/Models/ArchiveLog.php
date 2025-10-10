<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_name',
        'student_name',
        'record_id',
        'action',
        'category',
        'original_status',
    ];

    public function collegeStudent()
    {
        return $this->belongsTo(CollegeStudent::class, 'record_id', 'student_id');
    }

    public function shsStudent()
    {
        return $this->belongsTo(ShsStudent::class, 'record_id', 'student_id');
    }
}
