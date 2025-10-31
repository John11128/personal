@extends('welcome')


@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Editar Producto</h1>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar producto</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('productos.index') }}" class="btn btn-sm btn-default">Volver</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('productos.update', $producto->id_p) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        @include('modulos.productos.form', ['modo' => 'Editar'])
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection