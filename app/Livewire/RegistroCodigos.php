<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Codigo;
use App\Models\User;
use App\Models\RegistroFactura;
use App\Models\RegistroCodigo;
use Livewire\WithFileUploads;

class RegistroCodigos extends Component
{
    use WithFileUploads;

    // Models
    public $codigo, $foto_factura, $productos_auto, $productos_moto, $productos_energiteca_servicios;

    // Useful vars
    public $user, $codigos = [];

    public function render()
    {
        return view('livewire.registro-codigos');
    }

    public function mount(){
        $this->user = User::where('id', auth()->user()->id)->first();
    }

    public function register(){
        $this->validateCodigos();
        $this->validate([
            'productos_auto' => 'nullable|array',
            'productos_moto' => 'nullable|array',
            'productos_energiteca_servicios' => 'nullable|array',
            'foto_factura' => 'required|image|max:1024'
        ]);

        // Registro Factura
        $registro_factura = new RegistroFactura();
        $registro_factura->user_id = auth()->user()->id;
        $registro_factura->foto_factura = $this->foto_factura->store(path: 'public/facturas-shopper');
        $registro_factura->productos_auto = implode(", ", $this->productos_auto);
        $registro_factura->productos_moto = implode(", ", $this->productos_moto);
        $registro_factura->productos_energiteca_servicios = implode(", ", $this->productos_energiteca_servicios);
        $registro_factura->save();

        foreach ($this->codigos as $codigo){
            $codigo = Codigo::where([['codigo', $codigo],['estado_cod', 1]])->first();
            if ($codigo){
                // Codigo
                $codigo->estado_cod = 3;
                $codigo->save();

                // Registro Codigos
                $registro_codigo = new RegistroCodigo();
                $registro_codigo->factura_id = $registro_factura->id;
                $registro_codigo->codigo_id = $codigo->id;
                $registro_codigo->user_id = auth()->user()->id;
                $registro_codigo->save();
            }else {
                return redirect()->back()->with('codigo_error', "!Oops, el código ".$codigo." no existe o ya fue registrado");
            }
        }

        // User
        $this->user->estado_id = 4;
        $this->user->save();
        return redirect()->route('ruleta', ['factura_id' => $registro_factura->id])->with('success', 'Código registrado con éxito');
    }

    public function validateCodigos(){
        $this->validate([
            'codigos' => 'required|array|min:1'
        ]);

        foreach ($this->codigos as $codigo){
            $tempCodigo = Codigo::where([['codigo', $codigo],['estado_cod', 1]])->first();
            if (!$tempCodigo){
                return redirect()->back()->with('codigo_error', "!Oops, el código ".$tempCodigo." no existe o ya fue registrado");
            }
        }

        return true;
    }

    public function addCodigo(){
        $this->validate([
            'codigo' => 'required|string'
        ]);

        $codigo = Codigo::where([['codigo', $this->codigo],['estado_cod', 1]])->first();

        if ($codigo){
            array_push($this->codigos, ['codigo' => $this->codigo]);
        }else {
            return redirect()->back()->with('codigo_error', '!Oops, éste código no existe o ya fue registrado');
        }
    }

    public function removeCodigo($index){
        unset($this->codigos[$index]);
    }

    // UPDATES
    public function updatedFotoFactura(){
        $this->validate([
            'foto_factura' => 'required|image|max:1024'
        ]);
    }
}
