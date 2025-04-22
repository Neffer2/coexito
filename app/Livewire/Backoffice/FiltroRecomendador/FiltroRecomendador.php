<?php

namespace App\Livewire\Backoffice\FiltroRecomendador;

use Livewire\Component;
use App\Models\RegistroServicio;
use App\Models\Recomendador;
use App\Models\PuntoVenta;

class FiltroRecomendador extends Component
{
    public $recomendador_id, $fecha_inicio; // Campo para capturar el ID del recomendador desde el front

    public function render()
    {
        $resultados = [];

        if ($this->recomendador_id) {
            $resultados = RegistroServicio::select(
                'registro_servicios.id AS registro_servicio_id',
                'puntos_venta.nit AS nit_punto_venta',
                'puntos_venta.razon_social AS razon_social_punto_venta',
                'registro_servicios.foto_factura', // Traer el campo directamente como está en la base de datos
                'registro_servicios.created_at AS fecha_creacion',
                'recomendadores.id AS recomendador_id',
                'recomendadores.nombre AS nombre_recomendador',
                'recomendadores.cedula AS cedula_recomendador',
                'recomendadores.puntos AS puntos_recomendador'
            )
            ->join('recomendadores', 'registro_servicios.recomendador_id', '=', 'recomendadores.id')
            ->join('puntos_venta', 'recomendadores.pdv_id', '=', 'puntos_venta.id')
            ->where('registro_servicios.recomendador_id', $this->recomendador_id)
            ->orderBy('registro_servicios.created_at', 'desc')
            ->get();
        }


        return view('livewire.backoffice.filtro-recomendador.filtro-recomendador', [
            'resultados' => $resultados,
        ]);
    }
}