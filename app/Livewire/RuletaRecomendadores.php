<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class RuletaRecomendadores extends Component
{
    public $recomendador;

    public function seleccionarRecomendador()
    {

        $this->recomendador = DB::table('registro_servicios as rs')
            ->join('recomendadores as r', 'rs.recomendador_id', '=', 'r.id')
            ->select('rs.*', 'r.id as recomendador_id', 'r.nombre as recomendador_nombre')
            ->where('rs.estado_id', 1)
            ->where('rs.created_at', '<', '2025-07-08 23:59:59')
            ->inRandomOrder()
            ->first();

        return $this->recomendador;
    }

    public function render()
    {
        return view('livewire.ruleta-recomendadores');
    }
}
