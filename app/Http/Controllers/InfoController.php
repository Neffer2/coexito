<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;
use App\Models\User;

class InfoController extends Controller
{
    public function getAgente($documento){
        $agente = User::select('id', 'nombre', 'cedula')->where('cedula', $documento)->first();
        return response()->json($agente);
    }
}
