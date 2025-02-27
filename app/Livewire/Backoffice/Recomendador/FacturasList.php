<?php

namespace App\Livewire\BackOffice\Recomendador;

use Livewire\Component;
use App\Models\RegistroServicio;
use Livewire\WithPagination;

class FacturasList extends Component
{
    use WithPagination;

    // Models
    public $RegistroServicio, $num_factura, $nombre ,$cedula, $email;

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
            $filters_user[] = ['cedula', 'like', '%' . $this->cedula . '%'];
        }

        if ($this->email) {
            $filters_user[] = ['correo', 'like', '%' . $this->email . '%'];
        }

        $RegistroServicios = RegistroServicio::whereHas('recomendador', function ($query) use ($filters_user) {
            $query->where($filters_user);
        })->where($filters_factura)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.backoffice.recomendador.facturas-list', ['RegistroServicios' => $RegistroServicios]);
    }

    public function getRegistro($registro_id)
    {
        $this->RegistroServicio = RegistroServicio::find($registro_id);
    }
}


