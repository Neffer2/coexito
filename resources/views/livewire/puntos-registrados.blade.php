<div>
    <table>
        <tr>
            <td>Punto de venta</td>
            <td>Estado</td>
            <td>Fecha</td>
        </tr>
        @foreach ($registros as $registro)
            <tr>
                <td>{{ $registro->pdv->nom_cliente }}</td>
                <td>{{ $registro->estado_id }}</td>
                <td>{{ $registro->created_at }}</td>
            </tr>
        @endforeach
    </table>
</div>
