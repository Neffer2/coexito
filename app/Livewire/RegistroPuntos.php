<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PuntosVenta;
use App\Models\RegistroPunto;
use App\Models\Departamento;
use App\Models\User;
use Livewire\WithFileUploads;

class RegistroPuntos extends Component
{
    use WithFileUploads;

    // Models
    public $nit, $foto_factura, $foto_kit, $ciudad, $direccion, $departamento, $departamentos;

    // Useful vars 
    public $user; 

    public function render()
    {
        return view('livewire.registro-puntos');
    }

    public function mount(){
        $this->user = User::find(auth()->user()->id);
        $this->getDepartamentos();
    }

    public function getDepartamentos(){
        $this->departamentos = Departamento::all();
    }

    public function ActivarPunto()
    {
        $this->validate([
            'nit' => 'required|numeric',
            'foto_factura' => 'required|image|max:1024',
            'foto_factura' => 'required|image|max:1024',
            'foto_kit' => 'required|image|max:1024',
            'direccion' => 'required|string',
            'ciudad' => 'required|string'
        ]);

        $punto = PuntosVenta::where('nit', $this->nit)->first();

        if ($punto){
            $registro_exist = RegistroPunto::where([
                ['pdv_id', $punto->id],
                ['estado_id', '!=', 3]
            ])->first();
        }else {
            return redirect()->back()->with('nit-error', '!Oops, este nit no se encuentra en nuestra base de datos.');
        }

        if ($punto && !$registro_exist) {
            // Registro punto
            $registro = new RegistroPunto();
            $registro->user_id = $this->user->id;
            $registro->pdv_id = $punto->id;
            $registro->foto_factura = $this->foto_factura->store(path: 'facturas-asesores');
            $registro->foto_kit = $this->foto_kit->store(path: 'kits-asesores');
            $registro->estado_id = 2;
            $registro->save();

            // Punto venta
            $punto->direccion = $this->direccion;
            $punto->ciudad = $this->ciudad;
            $punto->update();

            // Users
            $this->user->puntos += 5; 
            $this->user->save();

            $this->dispatch('codigo-registrado');
            $this->reset(['nit', 'foto_factura', 'foto_kit', 'ciudad', 'direccion', 'departamento']);

            return redirect()->back()->with('success', 'Felicidades! el punto se activó exitósamente.');
        }else {
            return redirect()->back()->with('nit-error', '!Oops, este nit no existe o ya está activado en la promoción.');
        }
    }

}

