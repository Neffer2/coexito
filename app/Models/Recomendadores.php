<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendadores extends Model
{
    use HasFactory;

    protected $table = 'recomendadores';

    protected $fillable = [
        'nombre',
        'cedula',
        'celular',
        'correo',
        'ciudad',
        'pdv_id',
        'puntos',
    ];
}
