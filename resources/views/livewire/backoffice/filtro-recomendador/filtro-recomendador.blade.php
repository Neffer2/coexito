<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h5>Filtro Recomendador</h5>
            <a href="{{ route('dashboard') }}">Men&uacute;</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="recomendador_id" class="form-label">Recomendador ID</label>
                <input type="number" id="recomendador_id" wire:model.lazy="recomendador_id" class="form-control" placeholder="Ingrese el ID del recomendador">
            </div>


            @if($resultados && count($resultados) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Registro Servicio</th>
                            <th>NIT Punto de Venta</th>
                            <th>Razón Social</th>
                            <th>Foto Factura</th>
                            <th>Fecha Creación</th>
                            <th>ID Recomendador</th>
                            <th>Nombre Recomendador</th>
                            <th>Cédula Recomendador</th>
                            <th>Puntos Recomendador</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resultados as $resultado)
                            <tr>
                                <td>{{ $resultado->registro_servicio_id }}</td>
                                <td>{{ $resultado->nit_punto_venta }}</td>
                                <td>{{ $resultado->razon_social_punto_venta }}</td>
                                <td>
                                    <a href="{{ str_replace('public/', 'storage/', $resultado->foto_factura) }}" target="_blank">
                                        Ver Foto
                                    </a>
                                </td>
                                <td>{{ $resultado->fecha_creacion }}</td>
                                <td>{{ $resultado->recomendador_id }}</td>
                                <td>{{ $resultado->nombre_recomendador }}</td>
                                <td>{{ $resultado->cedula_recomendador }}</td>
                                <td>{{ $resultado->puntos_recomendador }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay resultados para mostrar.</p>
            @endif
        </div>
    </div>
</div>