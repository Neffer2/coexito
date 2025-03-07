<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h5>Lista de Usuarios - Shopper - Asesores</h5>
            <a href="{{ route('dashboard') }}">Men&uacute;</a>
            
            <div class="row mt-2">
                <div class="col-md-2">
                    <input type="text" wire:model.live="documento" class="form-control" placeholder="Número de documento">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="nombre" class="form-control" placeholder="Nombre">
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Rol</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->documento }}</td>
                            <td>{{ $user->telefono }}</td>
                            <td>{{ $user->direccion }}</td>
                            <td>{{ $user->ciudad }}</td>
                            <td>
                                @if ($user->rol_id == 1)
                                    Shopper
                                @elseif ($user->rol_id == 2)
                                    Asesor
                                @elseif ($user->rol_id == 3)
                                    Backoffice
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>