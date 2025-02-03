<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroServicio extends Model
{
    use HasFactory;
    protected $table = 'registro_servicios';

    public function recomendador()
    {
        return $this->belongsTo(Recomendador::class, 'recomendador_id');
    }
}
 