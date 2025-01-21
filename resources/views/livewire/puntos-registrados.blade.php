<div class="puntos-registrados">
    <h1>Puntos registrados</h1>
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
                {{-- <td>{{ $registro->pdv->nom_cliente }}</td>
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
                <td>{{ $registro->created_at }}</td> --}}
            </tr>
        @endforeach
        <tr>
            <td>Punto1</td>
            <td>123456789</td>
            <td>Medellin</td>
            <td>Aprobado</td>
            <td>2021-09-01</td>
        </tr>
    </table>
</div>
