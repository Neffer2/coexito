<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Codigo;
use App\Models\User;
use App\Models\RegistroCodigo;
use Livewire\WithFileUploads;

class RegistroCodigos extends Component
{
    use WithFileUploads;

    // Models
    public $codigo, $foto_factura, $tipo_producto;

    // Useful vars
    public $user;

    public function render()
    {
        return view('livewire.registro-codigos');
    }

    public function mount(){
        $this->user = User::where('id', auth()->user()->id)->first();
    }

    public function register(){
        $this->validate([
            'foto_factura' => 'required|image|max:1024',
            'tipo_producto' => 'required|string',
            'codigo' => 'required'
        ]);

        $codigo = Codigo::where([['codigo', $this->codigo],['estado_cod', 1]])->first();

        if ($codigo){
            // Codigo
            $codigo->estado_cod = 3;
            $codigo->save();

            // Registro Codigos
            $registro_codigo = new RegistroCodigo();
            $registro_codigo->codigo_id = $codigo->id;
            $registro_codigo->user_id = auth()->user()->id;
            $registro_codigo->foto_factura = $this->foto_factura->store(path: 'facturas-shopper');
            $registro_codigo->tipo_producto = $this->tipo_producto;
            $registro_codigo->save();

            // User
            $this->user->estado_id = 4;
            $this->user->save();

            return redirect()->route('ruleta')->with('success', 'Código registrado con éxito');
        }else {
            return redirect()->back()->with('codigo-error', '!Oops, éste código no existe o ya fue registrado');
        }
    }

    // UPDATES
    public function updatedFotoFactura(){
        $this->validate([
            'foto_factura' => 'required|image|max:1024'
        ]);
    }

    public function updatedTipoProducto(){
        $this->validate([
            'tipo_producto' => 'required|string'
        ]);
    }
}
