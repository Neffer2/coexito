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
    public $codigo, $foto_factura, $baterias_auto, $baterias_moto, $lubricantes_auto, $lubricantes_moto, $energiteca;

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
            'baterias_auto' => 'nullable|boolean',
            'baterias_moto' => 'nullable|boolean',
            'lubricantes_auto' => 'nullable|boolean',
            'lubricantes_moto' => 'nullable|boolean',
            'energiteca' => 'nullable|boolean',
            'foto_factura' => 'required|image|max:1024',
            'codigo' => 'required|string'
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
            $registro_codigo->baterias_auto = $this->baterias_auto;
            $registro_codigo->baterias_moto = $this->baterias_moto;
            $registro_codigo->lubricantes_auto = $this->lubricantes_auto;
            $registro_codigo->lubricantes_moto = $this->lubricantes_moto;
            $registro_codigo->energiteca = $this->energiteca;
            $registro_codigo->save();

            // User
            $this->user->estado_id = 4;
            $this->user->save();

            return redirect()->route('ruleta')->with('success', 'Código registrado con éxito');
        }else {
            return redirect()->back()->with('codigo_error', '!Oops, éste código no existe o ya fue registrado');
        }
    }

    // UPDATES
    public function updatedFotoFactura(){
        $this->validate([
            'foto_factura' => 'required|image|max:1024'
        ]);
    }
}
