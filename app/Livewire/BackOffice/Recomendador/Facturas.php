<?php

namespace App\Livewire\Backoffice\Recomendador;

use Livewire\Component;
use App\Models\RegistroServicio;
use Livewire\WithPagination; 

class Facturas extends Component
{
    use WithPagination;
    
    // Models
    public $RegistroServicio, $observaciones;

    public function render() 
    {
        $RegistroServicios = RegistroServicio::where('estado_id', 2)->paginate(10);
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
 