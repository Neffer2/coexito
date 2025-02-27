<?php

namespace App\Livewire\BackOffice\FuerzaVentas;

use Livewire\Component;
use App\Models\RegistroPunto;
use Livewire\WithPagination;

class Puntos extends Component
{
    use WithPagination;

    public $RegistroPunto, $observaciones, $id_pdv, $id_correo;

    public function render()
    {

        $query = RegistroPunto::where('estado_id', 2);

        if ($this->id_pdv) {
            $query->where('id', $this->id_pdv);
        }

        if ($this->id_correo) {
            $query->whereHas('user', function ($q) {
                $q->where('email', 'like', '%' . $this->id_correo . '%');
            });
        }

        $registroPuntos = $query->orderBy('id', 'desc')->paginate(10);
        return view('livewire.backoffice.fuerza-ventas.puntos', [
            'registroPuntos' => $registroPuntos
        ]);
    }

    public function getRegistro($registro_id)
    {
        $this->RegistroPunto = RegistroPunto::find($registro_id);
    }

    public function validacionRegistro($validacion)
    {
        if ($validacion){
            $this->validate([
                'observaciones' => ['required', 'string']
            ]);

            $this->RegistroPunto->estado_id = 1;
            $this->RegistroPunto->observaciones = $this->observaciones;
            $this->RegistroPunto->save();

            $this->RegistroPunto->user->puntos += 5;
            $this->RegistroPunto->user->save();

            $this->RegistroPunto->pdv->estado_id = 1;
            $this->RegistroPunto->pdv->save();

            $message = 'Registro APROBADA exitosamente.';
        }else {
            $this->validate([
                'observaciones' => ['required', 'string']
            ]);

            $this->RegistroPunto->estado_id = 3;
            $this->RegistroPunto->observaciones = $this->observaciones;
            $this->RegistroPunto->save();

            $this->RegistroPunto->pdv->estado_id = 3;
            $this->RegistroPunto->pdv->save();

            $message = 'Registro RECHAZADA exitosamente.';
        }

        $this->reset(
            'RegistroPunto',
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
