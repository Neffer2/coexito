<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCodigo extends Model
{
    use HasFactory;
    protected $table = 'registro_codigos';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function codigo(){
        return $this->belongsTo(Codigo::class);
    }
}
