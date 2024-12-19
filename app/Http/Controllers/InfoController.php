<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agente;
use App\Models\PuntosVenta;
use App\Models\Recomendadores;

class InfoController extends Controller
{
    public function getAgente($documento){
        $agente = Agente::select('id', 'nombre', 'cedula', 'puntos')->where('cedula', $documento)->first();
        if(!$agente){
            return response()->json(['message' => 'Agente no encontrado'], 404);
        }
        return response()->json($agente);
    }

    public function getPuntoVenta($nit){
        $puntoVenta = PuntosVenta::select('id', 'nit', 'nom_cliente')->where('nit', $nit)->first();
        if(!$puntoVenta){
            return response()->json(['message' => 'Punto de venta no encontrado'], 404);
        }
        return response()->json($puntoVenta);
    }

    public function getRecomendador($documento){
        $recomendadores = Recomendadores::select('id', 'nombre', 'cedula', 'puntos')->where('cedula', $documento)->get();
        if(!$recomendadores){
            return response()->json(['message' => 'Recomendadores no encontrados'], 404);
        }
        return response()->json($recomendadores);
    }

}
