<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concern extends Model
{
    use HasFactory;

    protected $fillable = [
    'student_type',
    'first_name',
    'middle_name',
    'last_name',
    'email',
    'concern_type', // Idagdag ito
    'concern',
    'remarks',
    'submission_date',
    'status', // NEW
];

protected $casts = [
    'submission_date' => 'datetime',
];

public static function getPendingCount()
{
    return self::where('status', 'Pending')->where('is_read', 0)->count();
}

}