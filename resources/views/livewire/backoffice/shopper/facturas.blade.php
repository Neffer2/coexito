<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-end mb-3">
        <a href="#" class="btn btn-danger"
            onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas cerrar sesión?')) { document.getElementById('logout-form').submit(); }">Cerrar
            sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="card">

        <div class="card-header">
            <h5>Registro de facturas</h5>
            {{-- <a href="{{ route('registros-factura') }}">Ver registros de factura</a> --}}
        </div>
        @isset($RegistroFactura)
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroFactura->user->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroFactura->user->email }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroFactura->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroFactura->user->documento }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroFactura->created_at }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Ciudad:</span>
                                {{ $RegistroFactura->user->ciudad }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="row">
                                    @php
                                        $foto_factura = str_replace('public/', '', $RegistroFactura->foto_factura);
                                    @endphp
                                    <div class="col-12">
                                        <div class="form-group d-flex flex-column">
                                            <label for="">Foto de factura:</label>
                                            <a href="{{ asset("storage/$foto_factura") }}" target="_blank">
                                                <img src="{{ asset("storage/$foto_factura") }}" height="250"
                                                    width="250">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">N&uacute;mero de factura:</label>
                                            <input wire:model.lazy="num_factura" type="text" class="form-control">
                                            @error('num_factura')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-respondive">
                                             <table class="table">
                                                 <tr>
                                                     <td>#</td>
                                                     <td>Codigo</td>
                                                     <td>Fecha</td>
                                                 </tr>
                                                 @foreach ($RegistroFactura->codigos as $key => $codigo)
                                                     <tr>
                                                         <td>{{ $key+=1 }}</td>
                                                         <td>{{ $codigo->codigo->codigo }}</td>
                                                         <td>{{ $codigo->created_at }}</td>
                                                     </tr>
                                                 @endforeach
                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label for="">Observaciones:</label>
                                            <textarea wire:model.lazy="observaciones" cols="30" rows="5" class="form-control"></textarea>
                                            @error('observaciones')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button class="btn btn-success" wire:click="validacionRegistro(1)"
                                            wire:confirm="¿Estas segur@ de APROBAR esta factura?"> Aprobar factura</button>
                                        <button class="btn btn-danger" wire:click="validacionRegistro(0)"
                                            wire:confirm="¿Estas segur@ de RECHAZAR esta factura?"> Rechazar factura</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="card-body">
            @foreach ($RegistrosFactura as $RegistroFactura)
                <div class="card my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroFactura->user->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroFactura->user->email }}
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroFactura->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroFactura->user->documento }}
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroFactura->created_at }}
                            </div>
                            <div class="col-2">
                                <button wire:click="getRegistro({{ $RegistroFactura->id }})" class="btn btn-primary">
                                    Ver mas </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card-body">
                {{ $RegistrosFactura->links() }}
            </div>
        </div>
    </div>
</div>