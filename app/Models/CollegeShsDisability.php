<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeShsDisability extends Model
{
    protected $table = 'college_shs_disability';
    protected $primaryKey = 'disability_id';
    public $timestamps = true;

    protected $fillable = ['disability_name'];
}