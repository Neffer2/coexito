<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;
use App\Models\PuntosVenta;
use App\Models\Recomendador;
use App\Models\RegistroServicio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InfoController extends Controller
{
    /* GETTERS */
    public function getAgente($documento)
    {
        $agente = Agente::select('id', 'nombre', 'cedula', 'puntos')->where('cedula', $documento)->first();
        if (!$agente) {
            return response()->json(['message' => 'Agente no encontrado'], 404);
        }
        return response()->json($agente);
    }

    public function getRecomendador($documento)
    {
        $recomendador = Recomendador::select('id', 'nombre', 'cedula', 'puntos')->where('cedula', $documento)->get();
        if (!$recomendador) {
            return response()->json(['message' => 'Recomendadores no encontrados'], 404);
        }
        return response()->json($recomendador);
    }

    public function getPuntoVenta($nit)
    {
        $puntoVenta = PuntosVenta::select('id', 'nit', 'nombre_comercial')->where([
            ['nit', $nit],
            ['estado_id', 1]
        ])->first();
        if (!$puntoVenta) {
            return response()->json(['message' => 'Punto de venta no encontrado'], 404);
        }
        return response()->json($puntoVenta);
    }
    /* ** */

    /* VALIDATIONS */
    public function validateCedula($cedula, $rol)
    {
        if ($rol == 'recomendador') {
            $user = Recomendador::where('cedula', $cedula)->first();
            if ($user) {
                return response()->json(['message' => 'Cedula ya registrada', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Cedula disponible', 'status' => 200], 200);
        }

        return response()->json(['message' => 'Rol invalido', 'status' => 404], 404);
    }

    public function validateCelular($celular, $rol)
    {
        if ($rol == 'recomendador') {
            $user = Recomendador::where('celular', $celular)->first();
            if ($user) {
                return response()->json(['message' => 'Celular ya registrado', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Celular disponible', 'status' => 200], 200);
        }

        return response()->json(['message' => 'Rol invalido', 'status' => 404], 404);
    }

    public function validateCorreo($correo, $rol)
    {
        if ($rol == 'recomendador') {
            $user = Recomendador::where('correo', $correo)->first();
            if ($user) {
                return response()->json(['message' => 'Correo ya registrado', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Correo disponible', 'status' => 200], 200);
        }

        return response()->json(['message' => 'Rol invalido', 'status' => 404], 404);
    }
    /* ** */

    /* REGISTROS SERVICIOS/VENTAS/VISITAS */
    public function registrarServicio(Request $request)
    {
        $request->validate([
            'recomendador_id' => 'required',
            'segmento' => 'required',
            'valor_factura' => 'required',
            'num_bonos' => 'required',
            'foto_factura' => 'required'
        ]);



        $foto_factura = (!is_null($request->foto_factura)) ? $this->uploadFile($request->foto_factura) : null;
        $num_bonos = (int) $request->num_bonos;
        $valor_factura_int = (int) $request->valor_factura;

        $servicio = new RegistroServicio;
        $recomendador = Recomendador::find($request->recomendador_id);
        $servicio->recomendador_id = $request->recomendador_id;
        $servicio->num_factura = NULL;
        $servicio->segmento = $request->segmento;
        $servicio->num_bonos = $num_bonos;
        $servicio->foto_factura = $foto_factura;

        // Inicializa el estado y observación por defecto
        $estado = 0;
        $observacion = 'Pendiente';
        if ($request->segmento == 'Moto') {
            $valor_factura = floor($valor_factura_int/ 40000);
            if ($valor_factura == $num_bonos) {
                $estado = 1;
                $observacion = 'Aprobado';
                $recomendador->puntos += 1;
            } else {
                $estado = 3;
                $observacion = 'Rechazado: La cantidad de bonos no coincide con el valor de tu factura';
            }
        }

        if ($request->segmento == 'Carro') {
            $valor_factura = floor($valor_factura_int/ 80000);
            if ($valor_factura == $num_bonos) {
                $estado = 1;
                $observacion = 'Aprobado';
                $recomendador->puntos += 1;
            } else {
                $estado = 3;
                $observacion = 'Rechazado: La cantidad de bonos no coincide con el valor de tu factura';
            }
        }

        $servicio->valor_factura = $request->valor_factura;
        $servicio->estado_id = $estado;
        $servicio->observaciones = $observacion;
        if ($servicio->save()) {
            $recomendador->save();
            return response()->json(['message' => 'Registro exitoso', 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Error al registrar el servicio', 'status' => 404], 404);
        }
    }
    /* ** */

    /* REGISTROS */
    public function setRecomendador(Request $request)
    {

        $request->validate([
            'pdv_id' => 'required',
            'nombre' => 'required',
            'cedula' => 'required | unique:recomendadores',
            'celular' => 'required | unique:recomendadores',
            'correo' => 'required | unique:recomendadores',
            'ciudad' => 'required'
        ]);

        $recomendador = Recomendador::create([
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
    /* ** */

    public function uploadFile($url)
    {
        $imageContent = file_get_contents($url);

        // Crea un nombre único para la imagen
        $path = "public/photos/" . Str::uuid() . ".jpg";
        Storage::disk('local')->put($path, $imageContent);

        return $path;
    }
}
