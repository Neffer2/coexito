<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RegistroPunto;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class PuntosRegistrados extends Component
{
    use WithPagination;

    #[On('punto-activado')]
    public function render()
    {
        $registros = RegistroPunto::select('user_id', 'pdv_id', 'estado_id', 'created_at')
                    ->where('user_id', auth()->user()->id)
                    ->paginate(5);

        return view('livewire.puntos-registrados', ['registros' => $registros]);
    }
}
