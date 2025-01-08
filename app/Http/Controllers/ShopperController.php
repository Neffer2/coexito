<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RegistroCodigo;
use App\Models\Premio;

class ShopperController extends Controller
{
    public function index(){
        return;
    }

    public function storePremio(Request $request){
        $request->validate([
            'premio' => 'required|numeric'
        ]);

        $premio = Premio::find($request->premio);
        if ($premio){
            // Registro Codigos
            $registro_codigo = new RegistroCodigo();
            $registro_codigo->user_id = auth()->user()->id;
            $registro_codigo->premio_id = $premio->id;
            $registro_codigo->save();

            // Stock
            $premio->stock -=1;
            $premio->save();
        }
        
        // User
        $user = User::where('id', auth()->user()->id)->first();
        $user->estado_id = 1;
        $user->save();

        return json_encode([
            'status' => 200,
            'message' => "Registro exitoso"
        ]);
    }
}
