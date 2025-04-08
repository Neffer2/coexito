<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h5>Lista de Bonos</h5>
            <a href="{{ route('dashboard') }}">Men&uacute;</a>
        </div>
        <div class="card-body">
            <p>Total de premios entregados en la plataforma: <strong>{{ $totalPremios }}</strong></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Bono</th>
                        <th>Stock Inicial</th>
                        <th>Stock Plataforma</th>
                        <th>Total Premios Aprobados</th>
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
                            <td>
                                @php
                                    // Buscar el stock inicial en la colección de premios
                                    $stockInicial = match($premio->premio_id) {
                                        101 => 2000,
                                        102 => 1000,
                                        103 => 500,
                                        104 => 50,
                                        default => 'N/A',
                                    };
                                @endphp
                                {{ $stockInicial }}
                            </td>
                            <td>
                                @php
                                    // Buscar el stock actual en la colección de premios
                                    $stockActual = $premiosConStock->firstWhere('id', $premio->premio_id)->stock ?? 'N/A';
                                @endphp
                                {{ $stockActual }}
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