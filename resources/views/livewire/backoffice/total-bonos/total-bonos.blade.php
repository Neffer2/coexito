<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h5>Lista de Usuarios - Shopper - Asesores</h5>
            <a href="{{ route('dashboard') }}">Men&uacute;</a>
        </div>
        <div class="card-body">
            <p>Total de premios en la plataforma: <strong>{{ $totalPremios }}</strong></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Premio</th>
                        <th>Total</th>
                        <th>Promedio Diario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($premiosPorCategoria as $premio)
                        <tr>
                            <td>
                                @if ($premio->premio_id == 101)
                                    20000
                                @elseif ($premio->premio_id == 102)
                                    30000
                                @elseif ($premio->premio_id == 103)
                                    50000
                                @elseif ($premio->premio_id == 104)
                                    100000
                                @else
                                    {{ $premio->premio_id }}
                                @endif
                            </td>
                            <td>{{ $premio->total }}</td>
                            <td>{{ $premio->promedio_diario }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>