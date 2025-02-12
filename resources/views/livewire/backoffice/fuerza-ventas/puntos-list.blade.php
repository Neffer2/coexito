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
            <h5>Lista de puntos Fuerza de ventas</h5>
            <div class="row">
                <div class="col-md-2">
                    <input type="text" wire:model.live="nit" class="form-control" placeholder="NIT">
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
                <div class="col-12">
                    <a href="{{ route('backoffice-fv') }}">Volver</a>
                    <a href="{{ route('dashboard') }}">Men&uacute;</a>
                </div>
            </div>
        </div>
        @isset($RegistroPunto)
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $RegistroPunto->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroPunto->user->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroPunto->user->email }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroPunto->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroPunto->user->documento }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroPunto->created_at }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Ciudad:</span>
                                {{ $RegistroPunto->user->ciudad }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Estado:</span>
                                @if ($RegistroPunto->estado_id == 1)
                                    <span class="badge bg-success">Aprobado</span>
                                @elseif($RegistroPunto->estado_id == 2)
                                    <span class="badge bg-warning">Revisión</span>
                                @else
                                    <span class="badge bg-danger">Rechazado</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-2">
                            <div class="col-12">
                                <div class="card card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <th>Nit</th>
                                                <th>Raz&oacute;n social</th>
                                                <th>Nombre comercial</th>
                                                <th>Nombre contacto</th>
                                                <th>Tel&eacute;fono</th>
                                                <th>Direcci&oacute;n</th>
                                                <th>Ciudad</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $RegistroPunto->pdv->nit }}</td>
                                                    <td>{{ $RegistroPunto->pdv->razon_social }}</td>
                                                    <td>{{ $RegistroPunto->pdv->nombre_comercial }}</td>
                                                    <td>{{ $RegistroPunto->pdv->nombre_contacto }}</td>
                                                    <td>{{ $RegistroPunto->pdv->telefono }}</td>
                                                    <td>{{ $RegistroPunto->pdv->direccion }}</td>
                                                    <td>{{ $RegistroPunto->pdv->ciudad }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label for="">Observaciones:</label>
                                    <textarea disabled cols="30" rows="1" class="form-control">{{ $RegistroPunto->observaciones }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="card-body">
            @foreach ($registroPuntos as $registroPunto)
                <div class="card my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $registroPunto->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $registroPunto->user->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $registroPunto->user->email }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Celular:</span>
                                {{ $registroPunto->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $registroPunto->user->documento }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Fecha:</span>
                                {{ $registroPunto->created_at }}
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">Estado:</span>
                                @if ($registroPunto && $registroPunto->estado_id == 1)
                                    <span class="badge bg-success">Aprobado</span>
                                @elseif ($registroPunto && $registroPunto->estado_id == 2)
                                    <span class="badge bg-warning">Revisión</span>
                                @else
                                    <span class="badge bg-danger">Rechazado</span>
                                @endif
                            </div>
                            <div class="col-2">
                                <button wire:click="getRegistro({{ $registroPunto->id }})" class="btn btn-primary">
                                    Ver mas </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card-body">
                {{ $registroPuntos->links() }}
            </div>
        </div>
    </div>
</div>
