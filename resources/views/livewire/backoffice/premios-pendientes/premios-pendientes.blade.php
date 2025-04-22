<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h5>Premios Pendientes</h5>
            <a href="{{ route('dashboard') }}">Men&uacute;</a>
        </div>
        <div class="card-body">
            @if($premiosPendientes && count($premiosPendientes) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Factura ID</th>
                            <th>Estado Factura</th>
                            <th>Premio</th>
                            <th>Usuario</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Ciudad</th>
                            <th>Email</th>
                            <th>Fecha Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($premiosPendientes as $premio)
                            <tr>
                                <td>{{ $premio->id }}</td>
                                <td>{{ $premio->factura_id }}</td>
                                <td>{{ $premio->estado_factura }}</td>
                                <td>{{ $premio->premio_descripcion }}</td>
                                <td>{{ $premio->user_nombre }}</td>
                                <td>{{ $premio->user_documento }}</td>
                                <td>{{ $premio->user_telefono }}</td>
                                <td>{{ $premio->user_direccion }}</td>
                                <td>{{ $premio->user_ciudad }}</td>
                                <td>{{ $premio->user_email }}</td>
                                <td>{{ $premio->fecha_creacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay premios pendientes para mostrar.</p>
            @endif
        </div>
    </div>
</div>