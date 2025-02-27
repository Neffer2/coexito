<?php

namespace App\Livewire\BackOffice\ListaShopper;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class ListaShopper extends Component
{
    use WithPagination;

    public $nombre, $documento;

    public function render()
    {
        $query = User::query();

        if ($this->nombre) {
            $query->where('nombre', 'like', '%' . $this->nombre . '%');
        }
        // Busqueda por documento ---
        if ($this->documento) {
            $query->where('documento', 'like', '%' . $this->documento . '%');
        }

        $users = $query->orderBy('id', 'desc')->paginate(10);
        return view('livewire.backoffice.lista-shopper.lista-shopper', ['users' => $users]);
    }
}