<?php

namespace App\Livewire\BackOffice\TotalBonos;

use Livewire\Component;
use App\Models\RegistroPremio;
use Livewire\WithPagination;

class TotalBonos extends Component
{
    use WithPagination;

    public $nombre, $documento;
    public $totalPremios; // Variable para almacenar el conteo total
    public $premiosPorCategoria; // Variable para almacenar el conteo por premio_id

    public function mount()
    {
        // Obtener el conteo total de premios al montar el componente
        $this->totalPremios = RegistroPremio::count();

        // Calcular el rango de días (desde la primera fecha hasta la última)
        $fechaInicio = RegistroPremio::min('created_at'); // Primera fecha
        $fechaFin = RegistroPremio::max('created_at'); // Última fecha
        $diasTotales = now()->diffInDays($fechaInicio) + 1; // Diferencia en días (evitar división por 0)

        // Obtener el conteo de premios agrupados por premio_id y calcular el promedio diario
        $this->premiosPorCategoria = RegistroPremio::select('premio_id')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('ROUND(COUNT(*) / ?, 2) as promedio_diario', [$diasTotales])
            ->groupBy('premio_id')
            ->get();
    }

    public function render()
    {
        return view('livewire.backoffice.total-bonos.total-bonos', [
            'totalPremios' => $this->totalPremios,
            'premiosPorCategoria' => $this->premiosPorCategoria,
        ]);
    }
}