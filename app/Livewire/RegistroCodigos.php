<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Codigo;
use App\Models\User;
use App\Models\RegistroFactura;
use App\Models\RegistroCodigo;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class RegistroCodigos extends Component
{
    use WithFileUploads;

    // Models
    public $codigo, $foto_factura, $productos_auto, $productos_moto, $productos_energiteca_servicios;

    public $buttonText = 'Añadir';

    // Useful vars
    public $user, $codigos = [];

    public function render()
    {
        return view('livewire.registro-codigos');
    }

    public function mount()
    {
        $this->user = User::where('id', auth()->user()->id)->first();
    }

    public function register()
    {
        // Verificar si el usuario ha registrado una factura en los últimos 10 segundos
        $lastRegistro = RegistroFactura::where('user_id', auth()->user()->id)->latest()->first();
        if ($lastRegistro && $lastRegistro->created_at->gt(Carbon::now()->subSeconds(10))) {
            return redirect()->back()->with('codigo_error', 'Oops, tienes que esperar para volver a subir una factura');
        }

        $this->validateCodigos();
        $this->validate([
            'productos_auto' => 'nullable|array',
            'productos_moto' => 'nullable|array',
            'productos_energiteca_servicios' => 'nullable|boolean',
            'foto_factura' => 'required|image|max:1024'
        ]);

        // Registro Factura
        $registro_factura = new RegistroFactura();
        $registro_factura->user_id = auth()->user()->id;
        $registro_factura->foto_factura = $this->foto_factura->store(path: 'public/facturas-shopper');
        $registro_factura->estado_id = 1; //! Facturas aprobadas por defecto
        $registro_factura->productos_auto = ($this->productos_auto) ? implode(", ", $this->productos_auto) : null;
        $registro_factura->productos_moto = ($this->productos_moto) ? implode(", ", $this->productos_moto) : null;
        $registro_factura->productos_energiteca_servicios = $this->productos_energiteca_servicios;
        $registro_factura->observaciones = 'Aprobado por defecto.'; //! Facturas aprobadas por defecto
        $registro_factura->save();

        foreach ($this->codigos as $codigo) {
            $codigo = Codigo::where([['codigo', $codigo], ['estado_cod', 1]])->first();
            if ($codigo) {
                // Codigo
                $codigo->estado_cod = 3;
                $codigo->save();

                // Registro Codigos
                $registro_codigo = new RegistroCodigo();
                $registro_codigo->factura_id = $registro_factura->id;
                $registro_codigo->codigo_id = $codigo->id;
                $registro_codigo->user_id = auth()->user()->id;
                $registro_codigo->estado_id = 1; //! Códigos aprobados por defecto
                $registro_codigo->save();
            } else {
                return redirect()->back()->with('codigo_error', "!Oops, el código " . $codigo . " no existe o ya fue registrado");
            }
        }

        // User
        $this->user->estado_id = 1;
        // TODO: Cambiar en pruebas
        $this->user->save();
        return redirect()->route('home', ['factura_id' => $registro_factura->id])
            ->with('success', 'Código registrado con éxito')
            ->with('popup', true);
    }

    public function validateCodigos()
    {
        $this->validate([
            'codigos' => 'required|array|min:1'
        ]);

        foreach ($this->codigos as $codigo) {
            $tempCodigo = Codigo::where([['codigo', $codigo], ['estado_cod', 1]])->first();
            if (!$tempCodigo) {
                return redirect()->back()->with('codigo_error', "!Oops, el código " . $tempCodigo . " no existe o ya fue registrado");
            }
        }

        return true;
    }

    public function addCodigo()
    {
        $this->validate([
            'codigo' => 'required|string'
        ]);

        $codigo = Codigo::where([['codigo', $this->codigo], ['estado_cod', 1]])->first();

        if ($codigo) {
            foreach ($this->codigos as $codigo) {
                if ($codigo['codigo'] == $codigo || $codigo['codigo'] == $this->codigo) {
                    return redirect()->back()->with('codigo_error', '!Oops, éste código ya fue registrado');
                }
            }

            array_push($this->codigos, ['codigo' => $this->codigo]);
            $this->reset('codigo');
            $this->buttonText = 'Añadir más';
        } else {
            return redirect()->back()->with('codigo_error', '!Oops, éste código no existe o ya fue registrado');
        }
    }


    // UPDATES
    public function updatedFotoFactura()
    {
        $this->validate([
            'foto_factura' => 'required|image|max:1024'
        ]);
    }
}
