<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsYearLevel extends Model
{
    protected $table = 'shs_year_levels';
    protected $primaryKey = 'level_id'; // ⚠️ kasi `level_id` ang primary key
    public $timestamps = false; // kung walang created_at/updated_at

    // ✅ IDAGDAG ANG level_id SA FILLABLE
    protected $fillable = ['level_id', 'level_name'];
}