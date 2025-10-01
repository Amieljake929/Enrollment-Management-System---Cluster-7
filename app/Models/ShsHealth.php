<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShsHealth extends Model
{
    use HasFactory;

    protected $table = 'shs_health_info';

    protected $fillable = [
        'student_id',
        'condition_type',
        'condition',
        'weight_kg',
        'height_cm'
    ];

    public function student()
    {
        return $this->belongsTo(ShsStudent::class, 'student_id');
    }
}