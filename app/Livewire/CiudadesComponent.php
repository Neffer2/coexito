<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Departamento;

class CiudadesComponent extends Component
{
    // Models
    public $departamento, $departamentos;

    public function render()
    {
        return view('livewire.ciudades-component');
    }

    public function getDepartamentos(){
        $this->departamentos = Departamento::all();
    }

    public function mount(){
        $this->getDepartamentos();
    }
}