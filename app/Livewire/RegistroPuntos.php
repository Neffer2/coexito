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
    public $razon_social, $nom_comercial, $nom_contacto, $nit, $maps, $telefono, $ciudad, $direccion, $departamento, $departamentos, $bonos_entregados;

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
        $this->departamentos = Departamento::orderBy('descripcion', 'asc')->get();
    }

    public function ActivarPunto()
    {
        $this->validate([
            'nit' => 'required|numeric',
            'razon_social' => 'required|string|max:255',
            'nom_comercial' => 'required|string|max:255',
            'nom_contacto' => 'required|string|max:255',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'maps' => 'nullable|url',
            'bonos_entregados' => 'required|numeric'
        ]);

        // Punto venta
        $punto = new PuntosVenta;
        $punto->nit = $this->nit;
        $punto->razon_social = $this->razon_social;
        $punto->nombre_comercial = $this->nom_comercial;
        $punto->nombre_contacto = $this->nom_contacto;
        $punto->maps = $this->maps;
        $punto->telefono = $this->telefono;
        $punto->direccion = $this->direccion;
        $punto->ciudad = $this->ciudad;
        $punto->asesor_id = auth()->user()->id;
        $punto->estado_id = 1;
        $punto->save();

        // Registro punto
        $registro = new RegistroPunto();
        $registro->user_id = $this->user->id;
        $registro->pdv_id = $punto->id;
        $registro->estado_id = 2;
        $registro->bonos_entregados = $this->bonos_entregados;
        $registro->save();

        // Users
        /* SUMA CUNADO SE APRUEBE POR BACKOFFICE*/
        // $this->user->puntos += 5;
        // $this->user->save();

        $this->dispatch('punto-activado');
        $this->reset('nit', 'razon_social', 'nom_comercial', 'nom_contacto', 'telefono', 'direccion', 'ciudad', 'maps', 'bonos_entregados');
        return redirect()->back()->with('success', 'Felicidades! el punto se registró exitósamente.');
    }
}

