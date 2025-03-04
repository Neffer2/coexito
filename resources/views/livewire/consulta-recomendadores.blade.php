<!-- filepath: /c:/laragon/www/coexito/resources/views/livewire/consulta-recomendadores.blade.php -->
<div class="recomendadores-container">
    <div class="search-container">
        <input type="text" wire:model="search_recomendador" placeholder="Ingresa tu cédula" class="search-input">
        <button wire:click="buscar" class="search-button">Buscar</button>
    </div>

    <table class="historial-facturas">
        <thead>
            <tr class="table-header">
                <th>Num Factura</th>
                <th>Foto Factura</th>
                <th>Num Bonos</th>
                <th>Estado</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        @if (!empty($registro_servicios))
            <tbody>
                @foreach ($registro_servicios as $registro)
                    <tr>
                        <td class="codigo-cell" id="num_factura">{{ $registro->num_factura }}</td>
                        <td class="codigo-cell">
                            @php
                                $foto_factura = str_replace('public/', '', $registro->foto_factura);
                            @endphp
                            <a href="{{ asset('storage/' . $foto_factura) }}" target="_blank">Ver</a>
                        </td>
                        <td class="codigo-cell">{{ $registro->num_bonos }}</td>
                        <td class="codigo-cell">
                            @if ($registro->estado_id == 1)
                                Aprobado
                            @elseif ($registro->estado_id == 2)
                                Revisión
                            @elseif ($registro->estado_id == 3)
                                Rechazado
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="codigo-cell">{{ $registro->observaciones ?? 'N/A' }}  </td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
</div>