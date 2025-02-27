<?php

namespace App\Livewire\BackOffice\FuerzaVentas;

use Livewire\Component;
use App\Models\RegistroPunto;
use Livewire\WithPagination;

class PuntosList extends Component
{
    use WithPagination;

    public $RegistroPunto, $nit, $nombre ,$cedula, $email;

    public function render()
    {
        $filters_punto = [];
        $filters_user = [];

        if ($this->nit) {
            $filters_punto[] = ['nit', 'like', '%' . $this->nit . '%'];
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

        $registroPuntos = RegistroPunto::whereHas('user', function ($query) use ($filters_user) {
            $query->where($filters_user);
        })
        ->whereHas('pdv', function ($query) use ($filters_punto) {
            $query->where($filters_punto);
        })->orderBy('id', 'desc')->paginate(10);

        return view('livewire.backoffice.fuerza-ventas.puntos-list', [
            'registroPuntos' => $registroPuntos
        ]);
    }

    public function getRegistro($registro_id)
    {
        $this->RegistroPunto = RegistroPunto::find($registro_id);
    }
}
