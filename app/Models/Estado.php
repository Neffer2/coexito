<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'estados';

    /*
    |--------------------------------------------------------------------------
    | ESTADOS
    | * 1 = Activo/aprobado/Exitoso
    | * 2 = Revision/Pendiente
    | * 3 = Inactivo/Rechazado/Fallido
    | * 4 = Ruleta
    */
}
