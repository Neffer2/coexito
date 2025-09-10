<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtp extends Model
{
    use HasFactory;

    protected $table = 'user_otps';

    protected $fillable = [
        'user_id',
        'otp',
        'expires_at',
        'validated',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'validated' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
