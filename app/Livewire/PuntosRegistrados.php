<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RegistroPunto;
use App\Models\PuntosVenta;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class PuntosRegistrados extends Component
{
    use WithPagination;

    #[On('punto-activado')]
    public function render()
    {
        $registros = RegistroPunto::select('id', 'user_id', 'pdv_id', 'estado_id', 'created_at')
                    ->where('user_id', auth()->user()->id)
                    ->paginate(10);

        return view('livewire.puntos-registrados', ['registros' => $registros]);
    }

    public function eliminarPunto($punto_id)
    {
        $registro_punto = RegistroPunto::find($punto_id);
        $punto = PuntosVenta::find($registro_punto->pdv_id);

        if ($punto->recomendadores->isEmpty()){
            $registro_punto->delete();
            $punto->delete();
        }else{
            return redirect()->back()->with('error', 'No se puede eliminar el punto porque tiene recomendadores asociados');
        }

        return redirect()->back()->with('success', 'Punto eliminado correctamente');
    }
}
