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
            ->select('rc.codigo_id', 'c.codigo', 'rc.user_id', 'u.nombre')
            ->where('rc.estado_id', 1)
            ->inRandomOrder()
            ->first();
            
    }

    public function render()
    {
        return view('livewire.ruleta-sorteo');
    }
}