<div>
    <input type="text" wire:model.live="search" placeholder="Buscar categorías..." class="form-control mb-4">
    
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $cat)
                <tr>
                    <td>{{ $cat->id_c }}</td>
                    <td>{{ $cat->nombre }}</td>
                    <td>{{ $cat->descripcion }}</td>
                    <td>
                        @if($cat->estado)
                            <span class="label label-success">Activa</span>
                        @else
                            <span class="label label-default">Inactiva</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('categorias.edit', $cat->id_c) }}" class="btn btn-xs btn-primary">Editar</a>
                        <a href="{{ route('categorias.desactivar', $cat->id_c) }}" class="btn btn-xs {{ $cat->estado ? 'btn-warning' : 'btn-success' }}">
                            {{ $cat->estado ? 'Desactivar' : 'Activar' }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $categorias->links() }} 
</div>