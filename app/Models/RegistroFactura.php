<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroFactura extends Model
{
    use HasFactory;
    protected $table = 'registro_facturas';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function codigos(){
        return $this->hasMany(RegistroCodigo::class, 'factura_id', 'id');
    }
}
