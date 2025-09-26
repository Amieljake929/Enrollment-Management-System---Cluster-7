<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeDocument extends Model
{
    protected $table = 'college_documents';
    protected $primaryKey = 'doc_id';
    public $timestamps = false;

    protected $fillable = ['document_name', 'type_id'];
}
