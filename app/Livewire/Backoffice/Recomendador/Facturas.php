<?php

namespace App\Livewire\BackOffice\Recomendador;

use Livewire\Component;
use App\Models\RegistroServicio;
use Livewire\WithPagination;

class Facturas extends Component
{
    use WithPagination;

    // Models
    public $RegistroServicio, $observaciones, $id_recomendador, $id_nit, $id_cedula, $id_nombre;

    public function render()
    {
        $query = RegistroServicio::where('estado_id', 2);

        if ($this->id_recomendador) {
            $query->where('id', $this->id_recomendador);
        }

        if ($this->id_nit) {
            $query->whereHas('recomendador.pdv', function ($q) {
                $q->where('nit', 'like', '%' . $this->id_nit . '%');
            });
        }

        if ($this->id_cedula) {
            $query->whereHas('recomendador', function ($q) {
                $q->where('cedula', 'like', '%' . $this->id_cedula . '%');
            });
        }

        if ($this->id_nombre) {
            $query->whereHas('recomendador', function ($q) {
                $q->where('nombre', 'like', '%' . $this->id_nombre . '%');
            });
        }




        $RegistroServicios = $query->orderBy('id', 'desc')->paginate(10);
        return view('livewire.backoffice.recomendador.facturas', ['RegistroServicios' => $RegistroServicios]);
    }

    public function getRegistro($registro_id)
    {
        $this->RegistroServicio = RegistroServicio::find($registro_id);
    }

    public function validacionRegistro($validacion)
    {
        if ($validacion){
            $this->validate([
                'observaciones' => ['required', 'string']
            ]);

            $this->RegistroServicio->estado_id = 1;
            $this->RegistroServicio->observaciones = $this->observaciones;
            $this->RegistroServicio->save();

            $this->RegistroServicio->recomendador->puntos += 1;
            $this->RegistroServicio->recomendador->save();

            $message = 'Factura APROBADA exitosamente.';
        }else {
            $this->validate([
                'observaciones' => ['required', 'string']
            ]);

            $this->RegistroServicio->estado_id = 3;
            $this->RegistroServicio->observaciones = $this->observaciones;
            $this->RegistroServicio->save();

            $message = 'Factura RECHAZADA exitosamente.';
        }

        $this->reset(
            'RegistroServicio',
            'observaciones'
        );
        return redirect()->back()->with('success', $message);
    }

    // VALIDACIONES
    public function updatedObservaciones(){
        $this->validate([
            'observaciones' => ['required', 'string']
        ]);
    }
}
