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
    public $nit, $nombre, $telefono, $ciudad, $direccion, $departamento, $departamentos, $foto_punto;

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
            'nombre' => 'required|string',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'foto_punto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            $registro->estado_id = 2;
            $registro->save();

            // Punto venta
            $punto->nombre_contacto = $this->nombre;
            $punto->telefono = $this->telefono;
            $punto->direccion = $this->direccion;
            $punto->ciudad = $this->ciudad;
            $punto->foto_punto = $this->foto_punto->store(path: 'public/fotos-puntos');
            $punto->estado_id = 2;
            $punto->update();

            // Users
            /* SUMA CUNADO SE APRUEBE POR BACKOFFICE*/
            // $this->user->puntos += 5;
            // $this->user->save();

            $this->dispatch('punto-activado');
            $this->reset(['nit', 'nombre', 'telefono', 'ciudad', 'direccion', 'departamento', 'foto_punto']);
            return redirect()->back()->with('success', 'Felicidades! el punto se activó exitósamente.');
        }else {
            return redirect()->back()->with('nit-error', '!Oops, este nit no existe o ya está activado en la promoción.');
        }
    }

}

