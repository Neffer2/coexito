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
            <h5>Lista de registro de Servicios</h5>
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
                <div class="col-12"><a href="{{ route('backoffice-recomendador') }}">Volver</a></div>
            </div>
        </div>
        @isset($RegistroServicio)
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroServicio->recomendador->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroServicio->recomendador->correo }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroServicio->recomendador->celular }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroServicio->recomendador->cedula }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroServicio->created_at }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Ciudad:</span>
                                {{ $RegistroServicio->recomendador->ciudad }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Punto de venta:</span>
                                {{ $RegistroServicio->recomendador->pdv->nombre_comercial }}
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Estado:</span>
                                @if ($RegistroServicio->estado_id == 1)
                                    <span class="badge bg-success">Aprobado</span>
                                @elseif($RegistroServicio->estado_id == 2)
                                    <span class="badge bg-warning">Revisión</span>
                                @else
                                    <span class="badge bg-danger">Rechazado</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                @php
                                    $foto_factura = str_replace('public/', '', $RegistroServicio->foto_factura);
                                @endphp
                                <div class="form-group d-flex flex-column">
                                    <label for="">Foto de factura:</label>
                                    <a href="{{ asset("storage/$foto_factura") }}" target="_blank">
                                        <img src="{{ asset("storage/$foto_factura") }}" height="250"
                                            width="250">
                                    </a>
                                </div>
                                <div class="form-group d-flex flex-column">
                                    <label for="">Número de factura: {{ $RegistroServicio->num_factura }}</label>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group mb-2">
                                    <label for="">Observaciones:</label>
                                    <textarea disabled cols="30" rows="3" class="form-control">{{ $RegistroServicio->observaciones }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="card-body">
            @foreach ($RegistroServicios as $RegistroServicio)
                <div class="card my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroServicio->recomendador->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroServicio->recomendador->correo }} <br>
                                <span class="fw-bold">Punto de venta:</span>
                                {{ $RegistroServicio->recomendador->pdv->nombre_comercial }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroServicio->recomendador->celular }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroServicio->recomendador->cedula }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroServicio->created_at }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Estado:</span>
                                @if ($RegistroServicio->estado_id == 1)
                                    <span class="badge bg-success">Aprobado</span>
                                @elseif($RegistroServicio->estado_id == 2)
                                    <span class="badge bg-warning">Revisión</span>
                                @else
                                    <span class="badge bg-danger">Rechazado</span>
                                @endif
                            </div>
                            <div class="col-2">
                                <button wire:click="getRegistro({{ $RegistroServicio->id }})" class="btn btn-primary">
                                    Ver mas </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card-body">
                {{ $RegistroServicios->links() }}
            </div>
        </div>
    </div>
</div>
