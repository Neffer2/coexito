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
        $recomendador = Recomendadores::select('id', 'nombre', 'cedula', 'puntos')->where('cedula', $documento)->get();
        if(!$recomendador){
            return response()->json(['message' => 'Recomendadores no encontrados'], 404);
        }
        return response()->json($recomendador);
    }

    /* VALIDATIONS */
    public function validateCedula($cedula, $rol){
        if($rol == 'recomendador'){
            $user = Recomendadores::where('cedula', $cedula)->first();
            if($user){
                return response()->json(['message' => 'Cedula ya registrada', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Cedula disponible', 'status' => 200], 200);
        }elseif($rol == 'agente'){

        }

        return response()->json(['message' => 'Rol invalido', 'status' => 404], 404);
    }

    public function validateCelular($celular, $rol){
        if($rol == 'recomendador'){
            $user = Recomendadores::where('celular', $celular)->first();
            if($user){
                return response()->json(['message' => 'Celular ya registrado', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Celular disponible', 'status' => 200], 200);
        }elseif($rol == 'agente'){

        }

        return response()->json(['message' => 'Rol invalido', 'status' => 404], 404);
    }

    public function validateCorreo($correo, $rol){
        if($rol == 'recomendador'){
            $user = Recomendadores::where('correo', $correo)->first();
            if($user){
                return response()->json(['message' => 'Correo ya registrado', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Correo disponible', 'status' => 200], 200);
        }elseif($rol == 'agente'){

        }

        return response()->json(['message' => 'Rol invalido', 'status' => 404], 404);
    }
    /* ** */

    //Registrar recomendador
    public function setRecomendador(Request $request){

        $request->validate([
            'pdv_id' => 'required',
            'nombre' => 'required',
            'cedula' => 'required | unique:recomendadores',
            'celular' => 'required | unique:recomendadores',
            'correo' => 'required | unique:recomendadores',
            'ciudad' => 'required'
        ]);

        $recomendador = Recomendadores::create([
            'pdv_id' => $request->pdv_id,
            'nombre' => $request->nombre,
            'cedula' => $request->cedula,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'ciudad' => $request->ciudad,
            'puntos' => 0
        ]);

        return response()->json($recomendador);
    }
}
