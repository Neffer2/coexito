<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class RankingFuerzaVenta extends Component
{
    public function render()
    {
        $asesores = User::select('id', 'nombre', 'puntos')->where('rol_id', 2)->orderBy('puntos', 'desc')->limit(10)->get();
        $user_rank = User::where([
            ['rol_id', 2],
            ['puntos', '>' , auth()->user()->puntos]
            ])->count();

        return view('livewire.ranking-fuerza-venta', ['asesores' => $asesores, 'user_rank' => $user_rank]);
    }
}
