@extends('welcome')

@section('contenido')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Agregar Categoría</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Nueva categoría</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('categorias.index') }}" class="btn btn-sm btn-default">Volver</a>
                </div>
            </div>
            <div class="box-body">
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="box-footer text-right">
                        <button class="btn btn-success">Guardar</button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-default">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
