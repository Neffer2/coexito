<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class RuletaSorteo extends Component
{
    public $participante;

    public function seleccionarParticipante()
    {
        $this->participante = DB::table('registro_codigos as rc')
            ->join('codigos as c', 'rc.codigo_id', '=', 'c.id')
            ->join('users as u', 'rc.user_id', '=', 'u.id')
            ->join('registro_facturas as rf', 'rc.factura_id', '=', 'rf.id')
            ->select('rc.codigo_id', 'c.codigo', 'rc.user_id', 'u.nombre')
            ->where('rf.estado_id', 1)
            ->where('rc.created_at', '<', '2025-05-08 23:59:59')
            ->inRandomOrder()
            ->first();

        return $this->participante;
    }

    public function render()
    {
        return view('livewire.ruleta-sorteo');
    }
}
