@extends('welcome')


@section('contenido')

<div class="content-wrapper">
        <section class="content-header">
       <h1>Productos</h1>
        </section>

        <section class="content">
         <div class="box">
             <div class="box-header with-border">
                    <h3 class="box-title">Listado de Productos</h3>
             </div>


             <div class="box-body">



              <a href="{{ route('productos.index') }}" class="btn btn-default mb-3 pull-right">Ver Activos</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Precio Venta</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
            <tr>
                <td>{{ $p->id_p }}</td>
                <td>{{ $p->codigo_p }}</td>
                <td>{{ $p->nombre_p }}</td>
                <td>{{ $p->categoria->nombre ?? 'Sin categoría' }}</td>
                <td>{{ $p->stock_p }}</td>
                <td>
    @if($p->imagen_p)
        <img src="{{ asset('storage/' . $p->imagen_p) }}" 
             alt="Imagen del producto" 
             width="70" height="70" 
             class="rounded shadow-sm">
    @else
        <span class="text-muted">Sin imagen</span>
    @endif
</td>
                <td>${{ number_format($p->precio_venta_p, 2) }}</td>
                <td>
                    <span class="badge {{ $p->activo_p ? 'bg-success' : 'bg-danger' }}">
                        {{ $p->activo_p ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('productos.edit', $p->id_p) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('productos.toggle', $p->id_p) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <button class="btn btn-sm btn-secondary">
                            {{ $p->activo_p ? 'Desactivar' : 'Activar' }}
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
        </section>
 </div>



@endsection