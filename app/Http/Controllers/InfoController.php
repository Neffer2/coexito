<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;
use App\Models\User;

class InfoController extends Controller
{
    public function getAgente($documento){
        $agente = Agente::select('id', 'nombre', 'cedula', 'puntos')->where('cedula', $documento)->first();
        if(!$agente){
            return response()->json(['message' => 'Agente no encontrado'], 404);
        }

        return response()->json($agente);
    }

}
