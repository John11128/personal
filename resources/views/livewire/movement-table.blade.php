<div class="box-body">
    <div class="mb-3">
        <input type="text" wire:model.live="search" placeholder="Buscar por producto o ID..." class="form-control">
    </div>
    
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-hover align-middle">
        <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>


            </thead>
        <tbody>
            @foreach($movimientos as $mov)
            <tr wire:key="{{ $mov->id_m }}"> <td>{{ $mov->id_m }}</td>
                <td>{{ $mov->producto->nombre_p ?? '—' }}</td>
                <td>
                    @if(strtolower($mov->tipo_m) === 'entrada')
                        <span class="badge bg-success">Entrada</span>
                    @else
                        <span class="badge bg-danger">Salida</span>
                    @endif
                </td>
                <td>{{ $mov->cantidad_m }}</td>
                <td>{{ \Carbon\Carbon::parse($mov->fecha_m)->format('d/m/Y') }}</td>
                <td>{{ $mov->usuario->name ?? '—' }}</td>
                <td>
                    <a href="{{ route('movimientos.edit', $mov->id_m) }}" class="btn btn-sm btn-primary">Editar</a>
                    
                    <button wire:click="undoMovement({{ $mov->id_m }})" 
                            onclick="return confirm('¿Seguro que deseas deshacer este movimiento?')"
                            class="btn btn-warning btn-sm">
                        <i class="fas fa-undo"></i> Deshacer
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $movimientos->links() }}
</div>