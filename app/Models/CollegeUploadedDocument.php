<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeUploadedDocument extends Model
{
    protected $table = 'college_uploaded_documents';
    protected $primaryKey = 'upload_id';
    public $timestamps = false;

    protected $fillable = ['student_id', 'doc_id', 'file_path', 'file_type', 'type_id'];

    public function document()
    {
        return $this->belongsTo(CollegeDocument::class, 'doc_id', 'doc_id');
    }
}
