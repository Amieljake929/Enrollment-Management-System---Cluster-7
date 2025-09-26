<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginOtp extends Model
{
    use HasFactory;

    // Specify the table name explicitly (optional)
    protected $table = 'login_otps';

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',
        'otp_code',
        'expires_at',
    ];

    // Cast expires_at as datetime automatically
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // Optional: relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
