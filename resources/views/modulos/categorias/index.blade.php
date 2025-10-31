@extends('welcome')

@section('contenido')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Categorías</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listado de categorías</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-success">+ Nueva Categoría</a>
                </div>
            </div>
            <div class="box-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

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
                                <form action="{{ route('categorias.destroy', $cat->id_c) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
