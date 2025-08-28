<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsBranch extends Model
{
    protected $table = 'shs_branches';
    protected $primaryKey = 'branch_id';
    public $timestamps = false;
}