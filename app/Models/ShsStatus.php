<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShsStatus extends Model
{
    use HasFactory;

    protected $table = 'shs_status'; // custom table name

    protected $fillable = [
        'student_id',
        'info_status',
        'payment',
        'remarks',
    ];

    // Relationship: ShsStatus belongs to ShsStudent
    public function student()
    {
        return $this->belongsTo(ShsStudent::class, 'student_id', 'student_id');
    }
}
