<?php

namespace App\Livewire\BackOffice\Shopper;

use Livewire\Component;
use App\Models\RegistroFactura;
use Livewire\WithPagination;

class FacturasList extends Component
{
    use WithPagination;

    public $RegistroFactura, $num_factura, $nombre ,$cedula, $email;

    public function render()
    {
        $filters_factura = [];
        $filters_user = [];

        if ($this->num_factura) {
            $filters_factura[] = ['num_factura', 'like', '%' . $this->num_factura . '%'];
        }

        if ($this->nombre) {
            $filters_user[] = ['nombre', 'like', '%' . $this->nombre . '%'];
        }

        if ($this->cedula) {
            $filters_user[] = ['documento', 'like', '%' . $this->cedula . '%'];
        }

        if ($this->email) {
            $filters_user[] = ['email', 'like', '%' . $this->email . '%'];
        }

        $RegistrosFactura = RegistroFactura::whereHas('user', function ($query) use ($filters_user) {
            $query->where($filters_user);
        })->where($filters_factura)->orderBy('id', 'desc')->paginate(10);
        return view('livewire.backoffice.shopper.facturas-list', ['RegistrosFactura' => $RegistrosFactura]);
    }

    public function getRegistro($registro_id)
    {
        $this->RegistroFactura = RegistroFactura::find($registro_id);
    }
}
