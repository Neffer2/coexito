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

        <div class="card-header" id="top_header">
            <h5>Registro de Puntos de venta</h5>
            <a href="{{ route('backoffice-fv-list') }}">Lista de puntos Fuerza de ventas</a>
            <a href="{{ route('dashboard') }}">Men&uacute;</a>
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
                                    <textarea wire:model.lazy="observaciones" cols="30" rows="1" class="form-control"></textarea>
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
                            <div class="col-3">
                                <span class="fw-bold">Celular:</span>
                                {{ $registroPunto->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $registroPunto->user->documento }}
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Fecha:</span>
                                {{ $registroPunto->created_at }}
                            </div>
                            <div class="col-2">
                                <button wire:click="getRegistro({{ $registroPunto->id }})" class="btn btn-primary get_registro_btn">
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

<script>
    const topHeader = document.getElementById('top_header');
    const getRegistroBtn = document.querySelectorAll('.get_registro_btn');
    getRegistroBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            topHeader.scrollIntoView();
        });
    });
</script>
