<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeShsIndigenous extends Model
{
    protected $table = 'college_shs_indigenous';
    protected $primaryKey = 'indigenous_id';
    public $timestamps = true;

    protected $fillable = ['indigenous_name'];
}