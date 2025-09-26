<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsDocument extends Model
{
    protected $table = 'shs_documents';
    protected $primaryKey = 'doc_id'; // ⚠️ kung doc_id ang primary key
    public $timestamps = false;

    protected $fillable = ['doc_id', 'document_name'];
}