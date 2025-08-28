<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsEducationalBackground extends Model
{
    protected $table = 'shs_educational_background';
    protected $primaryKey = 'background_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id', 'primary_school', 'primary_year_graduated',
        'secondary_school', 'secondary_year_graduated',
        'last_school_attended', 'last_school_year_graduated'
    ];
}