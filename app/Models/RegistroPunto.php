<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPunto extends Model
{
    use HasFactory;
    protected $table = 'registro_puntos';

    public function pdv()
    {
        return $this->belongsTo(PuntosVenta::class, 'pdv_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
