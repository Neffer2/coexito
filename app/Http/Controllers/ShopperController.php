<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RegistroCodigo;
use App\Models\RegistroPremio;
use App\Models\Premio;
use App\Traits\Mail;

class ShopperController extends Controller
{
    use Mail;

    public function index(){
        return view('ruleta');
    }

    public function storePremio(Request $request){
        $request->validate([
            'premio' => 'required|numeric'
        ]);

        $premio = Premio::where([
            ['id', $request->premio],
            ['stock', '>', 0]
        ])->first();

        if ($premio){
            // Registro Premio
            $registro_premio = new RegistroPremio();
            $registro_premio->premio_id = $premio->id;
            $registro_premio->user_id = auth()->user()->id;
            $registro_premio->save();

            // Stock
            $premio->stock -=1;
            $premio->save();
        }else{
            $this->sigueIntentando();
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
