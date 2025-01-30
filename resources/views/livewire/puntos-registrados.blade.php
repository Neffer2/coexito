<div class="puntos-registrados">
    <h1>Puntos Activados</h1>
    <table>
        <tr>
            <td>Punto de venta</td>
            <td>Nit</td>
            <td>Ciudad</td>
            <td>Estado</td>
            <td>Fecha</td>
            <td>Acciones</td>
        </tr>
        @foreach ($registros as $registro)
        <tr>
                @if ($registro->pdv)
                    <td>{{ $registro->pdv->nombre_comercial }}</td>
                    <td>{{ $registro->pdv->nit }}</td>
                    <td>{{ $registro->pdv->ciudad }}</td>
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
                    <td><button class="btn-eliminar-punto" wire:click="eliminarPunto({{ $registro->id }})">Eliminar punto</button></td>
                @endif
            </tr>
        @endforeach
    </table>

    {{ $registros->links() }}


    @session('success')
    <br>
        <div class="error">{{ session('success') }}</div>
    @endsession

    @session('error')
    <br>
        <div class="error">{{ session('error') }}</div>
    @endsession
</div>
