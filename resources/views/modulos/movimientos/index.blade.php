@extends('welcome')

@section('contenido')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Movimientos</h1>
        <h4 class="mb-0">Movimientos de Inventario</h4>
        <a href="{{ route('movimientos.create') }}" class="btn btn-success btn-sm">+ Nuevo Movimiento</a>
        <a href="{{ route('movimientos.desactivados') }}" class="btn btn-warning btn-sm pull-right">Movimientos Desactivados</a>
    </section>

        <section class="content">
         <div class="box">
             <div class="box-header with-border">
                    <h3 class="box-title">Listado de Movimientos</h3>
            </div>

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
                    <tr>
                        <td>{{ $mov->id_m }}</td>
                        <td>{{ $mov->producto->nombre_p ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $mov->tipo_m == 'Entrada' ? 'bg-success' : 'bg-danger' }}">
                                {{ $mov->tipo_m }}
                            </span>
                        </td>
                        <td>{{ $mov->cantidad_m }}</td>
                        
                        <td>{{ \Carbon\Carbon::parse($mov->fecha_m)->format('d/m/Y') }}</td>
                        <td>{{ $mov->usuario->name ?? '—' }}</td>
                        <td>
                            <a href="{{ route('movimientos.edit', $mov->id_m) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('movimientos.deshacer', $mov->id_m) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm" 
                                onclick="return confirm('¿Seguro que deseas deshacer este movimiento?')">
                                <i class="fas fa-undo"></i> Deshacer
                            </button>
                        </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
