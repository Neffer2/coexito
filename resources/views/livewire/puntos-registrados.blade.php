<div class="puntos-registrados">
    <h1>Puntos Activados</h1>
    <table>
        <tr>
            <td>Punto de venta</td>
            <td>Nit</td>
            <td>Ciudad</td>
            <td>Bonos</td>
            <td>Categoría</td>
            <td>Estado</td>
            <td>Fecha</td>
            {{-- <td>Acciones</td> --}}
        </tr>
        @foreach ($registros as $registro)
        <tr>
                @if ($registro->pdv)
                    <td>{{ $registro->pdv->nombre_comercial }}</td>
                    <td>{{ $registro->pdv->nit }}</td>
                    <td>{{ $registro->pdv->ciudad }}</td>
                    <td>{{ $registro->bonos_entregados }}</td>
                    <td>{{ $registro->pdv->categoria }}</td>
                    <td>
                        @if ($registro->estado_id == 1)
                            Aprobado
                        @elseif ($registro->estado_id == 2)
                            Revisi&oacute;n
                        @elseif ($registro->estado_id == 3)
                            Rechazado
                        @endif
                    </td>
                    <td>{{ $registro->created_at }}</td>
                    {{-- <td><button class="btn-eliminar-punto" wire:confirm="¿Estas seguro de eliminar este punto de venta?"
                        wire:click="eliminarPunto({{ $registro->id }})">Eliminar punto</button></td> --}}
                @endif
            </tr>
        @endforeach
    </table>
    <br>
    {{ $registros->links('vendor.pagination.bootstrap-4') }}
    <br>
    @session('success')
    <br>
        <div class="error">{{ session('success') }}</div>
    @endsession

    @session('error')
    <br>
        <div class="error">{{ session('error') }}</div>
    @endsession
</div>
