<?php

namespace App\Livewire\BackOffice\ListaRecomendador;

use Livewire\Component;
use App\Models\Recomendador;
use Livewire\WithPagination;

class ListaRecomendador extends Component
{
    use WithPagination;

    public $nombre, $cedula, $telefono;

    public function render()
    {
        $query = Recomendador::query();

        if ($this->nombre) {
            $query->where('nombre', 'like', '%' . $this->nombre . '%');
        }
        // Busqueda por documento ---
        if ($this->cedula) {
            $query->where('cedula', 'like', '%' . $this->cedula . '%');
        }

        if ($this->telefono) {
            $query->where('celular', 'like', '%' . $this->telefono . '%');
        }

        $recomendadores = $query->orderBy('id', 'desc')->paginate(10);
        return view('livewire.backoffice.lista-recomendador.lista-recomendador', ['recomendadores' => $recomendadores]);
    }
}