<div class="puntos-registrados">
    <h1>Puntos Activados</h1>
    <table>
        <tr>
            <td>Punto de venta</td>
            <td>Nit</td>
            <td>Ciudad</td>
            <td>Estado</td>
            <td>Fecha</td>
        </tr>
        @foreach ($registros as $registro)
            <tr>
                <td>{{ $registro->pdv->nombre_cliente }}</td>
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
            </tr>
        @endforeach
    </table>
</div>
