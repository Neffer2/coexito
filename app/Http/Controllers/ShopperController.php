<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RegistroCodigo;
use App\Models\RegistroFactura;
use App\Models\RegistroPremio;
use App\Models\Premio;
use App\Traits\Mail;

class ShopperController extends Controller
{
    use Mail;

    public function welcome()
    {
        if (auth()->user() && auth()->user()->rol_id == 1) {
            $registros_codigo = RegistroCodigo::where('user_id', auth()->user()->id)->latest()->take(10)->get();
            $registros_factura = RegistroFactura::where('user_id', auth()->user()->id)->latest()->take(10)->get();
            return view('welcome', ['registros_codigo' => $registros_codigo], ['registros_factura' => $registros_factura]);
        } elseif (auth()->user() && auth()->user()->rol_id == 3) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }

    public function index($factura_id)
    {
        return view('ruleta', ['factura_id' => $factura_id]);
    }

    public function storePremio(Request $request)
    {
        $request->validate([
            'premio' => 'required|numeric',
            'factura_id' => 'required|numeric'
        ]);

        // Verificar si ya existe un registro con el mismo factura_id
        $existingRegistro = RegistroPremio::where('factura_id', $request->factura_id)->first();
        if ($existingRegistro) {
            return response()->json([
                'status' => 400,
                'message' => "Esta factura ya exitste ya existe"
            ], 400);
        }

        $premio = Premio::where([
            ['id', $request->premio],
            ['stock', '>', 0]
        ])->first();

        if ($premio) {
            // Registro Premio
            $registro_premio = new RegistroPremio();
            $registro_premio->factura_id = $request->factura_id;
            $registro_premio->premio_id = $premio->id;
            $registro_premio->user_id = auth()->user()->id;
            $registro_premio->save();

            $this->premio($registro_premio->premio_id);
            // Stock
            $premio->stock -= 1;
            $premio->save();
        } else {
            $this->sigueIntentando();
        }

        // User
        $user = User::where('id', auth()->user()->id)->first();
        $user->estado_id = 1;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => "Registro exitoso"
        ]);
    }
}
