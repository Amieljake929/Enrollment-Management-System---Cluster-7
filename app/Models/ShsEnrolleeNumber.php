<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShsEnrolleeNumber extends Model
{
    protected $table = 'shs_enrollee_number';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['enrollee_no', 'student_id'];

    // Relationship to student
    public function student()
    {
        return $this->belongsTo(ShsStudent::class, 'student_id', 'student_id');
    }

    /**
     * Generate a unique 12-character alphanumeric enrollee number
     */
    public static function generateUniqueEnrolleeNo()
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        do {
            $code = '';
            for ($i = 0; $i < 12; $i++) {
                $code .= $chars[random_int(0, strlen($chars) - 1)];
            }
        } while (self::where('enrollee_no', $code)->exists());

        return $code;
    }
}