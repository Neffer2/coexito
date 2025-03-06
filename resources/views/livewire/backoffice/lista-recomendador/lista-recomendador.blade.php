<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h5>Lista de Usuarios - Recomendador</h5>
            <a href="{{ route('dashboard') }}">Men&uacute;</a>
            
            <div class="row mt-2">
                <div class="col-md-2">
                    <input type="text" wire:model.live="cedula" class="form-control" placeholder="Número de documento">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="nombre" class="form-control" placeholder="Nombre">
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Ciudad</th>
                        <th>PDV ID</th>
                        <th>Puntos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recomendadores as $recomendador)
                        <tr>
                            <td>{{ $recomendador->id }}</td>
                            <td>{{ $recomendador->nombre }}</td>
                            <td>{{ $recomendador->cedula }}</td>
                            <td>{{ $recomendador->celular }}</td>
                            <td>{{ $recomendador->correo }}</td>
                            <td>{{ $recomendador->ciudad }}</td>
                            <td>{{ $recomendador->pdv_id }}</td>
                            <td>{{ $recomendador->puntos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $recomendadores->links() }}
            </div>
        </div>
    </div>
</div>