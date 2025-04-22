<?php

namespace App\Livewire\Backoffice\PremiosPendientes;

use Livewire\Component;
use App\Models\RegistroPremio;
use App\Models\RegistroFactura;
use App\Models\Premio;
use App\Models\User;

class PremiosPendientes extends Component
{
    public function render()
    {
        $premiosPendientes = RegistroPremio::select(
            'registro_premios.id',
            'registro_premios.factura_id',
            'registro_facturas.estado_id AS estado_factura',
            'registro_premios.premio_id',
            'premios.descripcion AS premio_descripcion',
            'registro_premios.user_id',
            'users.nombre AS user_nombre',
            'users.documento AS user_documento',
            'users.telefono AS user_telefono',
            'users.direccion AS user_direccion',
            'users.ciudad AS user_ciudad',
            'users.email AS user_email',
            'registro_facturas.created_at AS fecha_creacion'
        )
        ->join('registro_facturas', 'registro_premios.factura_id', '=', 'registro_facturas.id')
        ->join('premios', 'registro_premios.premio_id', '=', 'premios.id')
        ->join('users', 'registro_premios.user_id', '=', 'users.id')
        ->where('registro_facturas.estado_id', 2)
        ->orderBy('registro_facturas.created_at', 'desc')
        ->get();

        return view('livewire.backoffice.premios-pendientes.premios-pendientes', [
            'premiosPendientes' => $premiosPendientes,
        ]);
    }
}