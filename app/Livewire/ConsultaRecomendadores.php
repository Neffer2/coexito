<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Recomendador;
use App\Models\RegistroServicio;

class ConsultaRecomendadores extends Component
{
    use WithPagination;

    public $search_recomendador;
    public $registro_servicios = [];

    public function buscar()
    {
         // Verifica si el campo de búsqueda no está vacío
    if (!empty($this->search_recomendador)) {
        $query = RegistroServicio::query();

        $query->whereHas('recomendador', function($q) {
            $q->where('cedula', $this->search_recomendador);
        });

        $this->registro_servicios = $query->orderBy('id', 'desc')->get();
    } else {
        // Si el campo de búsqueda está vacío, no traigas ningún registro
        $this->registro_servicios = [];
    }
    }

    public function render()
    {
        return view('livewire.consulta-recomendadores', [
            'registro_servicios' => $this->registro_servicios,
        ]);
    }
}