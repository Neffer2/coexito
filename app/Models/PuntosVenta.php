<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntosVenta extends Model
{
    use HasFactory;

    protected $table = 'puntos_venta';

    protected $fillable = [
        'nit',
        'nom_cliente',
    ];

    public function recomendadores(){
        return $this->hasMany(Recomendadores::class, 'pdv_id');
    }
}
