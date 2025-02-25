<div class="container my-5">
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
            <h5>Lista de registro de facturas</h5>
            <div class="row">
                <div class="col-md-2">
                    <input type="text" wire:model.live="num_factura" class="form-control" placeholder="Número de factura">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="cedula" class="form-control" placeholder="Cédula">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="email" class="form-control" placeholder="Correo">
                </div>
            </div>
            <div class="row">
                <div class="col-12"><a href="{{ route('backoffice-shopper') }}">Volver</a></div>
                <a href="{{ route('dashboard') }}">Men&uacute;</a>
            </div>
        </div>
        @isset($RegistroFactura)
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $RegistroFactura->id }}
                            </div>
                        </div>
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
                            <div class="row">
                                <div class="col-3">
                                    <span class="fw-bold">Productos Carro:</span>
                                    {{ $RegistroFactura->productos_auto }}
                                </div>
                                <div class="col-3">
                                    <span class="fw-bold">Productos Moto:</span>
                                    {{ $RegistroFactura->productos_moto }}
                                </div>
                                <div class="col-3">
                                    <span class="fw-bold">Energiteca:</span>
                                    @if ($RegistroFactura->productos_energiteca_servicios)
                                        {{ __('Sí') }}
                                    @else
                                        {{ __('No') }}
                                    @endif
                                </div>
                                <div class="col-3">
                                    <span class="fw-bold">Estado:</span>
                                    @if ($RegistroFactura->estado_id == 1)
                                        <span class="badge bg-success">Aprobado</span>
                                    @elseif($RegistroFactura->estado_id == 2)
                                        <span class="badge bg-warning">Revisión</span>
                                    @else
                                        <span class="badge bg-danger">Rechazado</span>
                                    @endif
                                </div>
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
                                            <input disabled value="{{ $RegistroFactura->num_factura }}" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row gy-2">
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6>Códigos redimidos</h6>
                                            </div>
                                            <div class="card-body">
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
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6>Premios ganados</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-respondive">
                                                     <table class="table">
                                                         <tr>
                                                             <td>#</td>
                                                             <td>Premio</td>
                                                             <td>Fecha</td>
                                                         </tr>
                                                         @foreach ($RegistroFactura->premios as $key => $premio)
                                                             <tr>
                                                                 <td>{{ $key+=1 }}</td>
                                                                 <td>{{ $premio->premio->descripcion }}</td>
                                                                 <td>{{ $premio->created_at }}</td>
                                                             </tr>
                                                         @endforeach
                                                     </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label for="">Observaciones:</label>
                                            <textarea disabled wire:model.lazy="observaciones" cols="30" rows="2" class="form-control">{{ $RegistroFactura->observaciones }}</textarea>
                                        </div>
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
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $RegistroFactura->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroFactura->user->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroFactura->user->email }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroFactura->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroFactura->user->documento }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroFactura->created_at }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Estado:</span>
                                @if ($RegistroFactura->estado_id == 1)
                                    <span class="badge bg-success">Aprobado</span>
                                @elseif($RegistroFactura->estado_id == 2)
                                    <span class="badge bg-warning">Revisión</span>
                                @else
                                    <span class="badge bg-danger">Rechazado</span>
                                @endif
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
