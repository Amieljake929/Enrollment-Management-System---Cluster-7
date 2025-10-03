<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsFourPs extends Model
{
    protected $table = 'shs_four_ps';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['student_id'];

    public function student()
    {
        return $this->belongsTo(ShsStudent::class, 'student_id', 'student_id');
    }
}