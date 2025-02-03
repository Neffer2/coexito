<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendador extends Model
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

    public function pdv()
    {
        return $this->belongsTo(PuntosVenta::class, 'pdv_id');
    }
}
