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
        $query = RegistroServicio::query();

        if ($this->search_recomendador) {
            $query->whereHas('recomendador', function($q) {
                $q->where('cedula', $this->search_recomendador);
            });
        }

        $this->registro_servicios = $query->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.consulta-recomendadores', [
            'registro_servicios' => $this->registro_servicios,
        ]);
    }
}