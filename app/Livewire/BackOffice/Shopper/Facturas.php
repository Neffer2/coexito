<?php

namespace App\Livewire\BackOffice\Shopper;

use App\Rules\num_factura; 
use Livewire\Component;
use App\Models\RegistroFactura;
use Livewire\WithPagination;

class Facturas extends Component 
{
    use WithPagination;

    // Models
    public $RegistroFactura, $num_factura, $observaciones;

    public function render()
    {
        $RegistrosFactura = RegistroFactura::where('estado_id', 2)->paginate(10);
        return view('livewire.backoffice.shopper.facturas', ['RegistrosFactura' => $RegistrosFactura]);
    }

    public function getRegistro($registro_id)
    {
        $this->RegistroFactura = RegistroFactura::find($registro_id);
    }

    public function validacionRegistro($validacion)
    {
        if ($validacion){
            $this->validate([
                'num_factura' => ['required', 'alpha_num:ascii', new num_factura],
                'observaciones' => ['required', 'string']
            ]);

            $this->RegistroFactura->num_factura = $this->num_factura;
            $this->RegistroFactura->estado_id = 1;
            $this->RegistroFactura->observaciones = $this->observaciones;
            $this->RegistroFactura->save();

            foreach ($this->RegistroFactura->codigos as $codigo){
                $codigo->estado_id = 1;
                $codigo->save();
            }

            $message = 'Factura APROBADA exitosamente.';
        }else {
            $this->validate([
                'observaciones' => ['required', 'string']
            ]);

            $this->RegistroFactura->num_factura = null;
            $this->RegistroFactura->estado_id = 3;
            $this->RegistroFactura->observaciones = $this->observaciones;
            $this->RegistroFactura->save();

            foreach ($this->RegistroFactura->codigos as $codigo){
                $codigo->estado_id = 3;
                $codigo->save();
            }

            $message = 'Factura RECHAZADA exitosamente.';
        }

        $this->reset(
            'RegistroFactura',
            'num_factura',
            'observaciones'
        );
        return redirect()->back()->with('success', $message);
    }

    // VALIDACIONES
    public function updatedNumFactura(){
        $this->validate([
            'num_factura' => ['required', 'alpha_num:ascii', new num_factura]
        ]);
    }

    public function updatedObservaciones(){
        $this->validate([
            'observaciones' => ['required', 'string']
        ]);
    }
}