<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShsReferral extends Model
{
    use HasFactory;

    protected $table = 'shs_referral';

    protected $fillable = [
        'student_id',
        'referral_source',
        'referral_name',
        'referral_relation'
    ];

    public function student()
    {
        return $this->belongsTo(ShsStudent::class, 'student_id');
    }
}