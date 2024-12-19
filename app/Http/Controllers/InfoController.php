<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;

class InfoController extends Controller
{
    public function getAgente($documento){
        $agente = Agente::select('id', 'nombre', 'cedula')->where('cedula', $documento)->first();
        return response()->json($agente);
    }
}
