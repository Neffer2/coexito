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
        // Shopper
        $query = User::query();

        if ($this->nombre) {
            $query->where('nombre', 'like', '%' . $this->nombre . '%');
        }

        if ($this->documento) {
            $query->where('documento', 'like', '%' . $this->documento . '%');
        }

        $users = $query->orderBy('id', 'desc')->paginate(10);
        return view('livewire.backoffice.lista-shopper.lista-shopper', ['users' => $users]);
    }
}