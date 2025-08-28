<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsUploadedDocument extends Model
{
    protected $table = 'shs_uploaded_documents';
    protected $primaryKey = 'upload_id';
    public $timestamps = false;

    protected $fillable = ['student_id', 'doc_id', 'file_path'];
}