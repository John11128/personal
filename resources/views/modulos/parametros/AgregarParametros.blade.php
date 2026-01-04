@extends('welcome')


@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
       <h2>Parametrización</h2>
    </section>

    <section class="content">

        {{-- Aquí muestra los mensajes de error --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="box">
      
            <div class="box-body">


                <form method="post" action="{{ route('Parametros.store', $parametros->id_parametro) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <div class="form-group">
                        <label for="nombre_Sistema">Nombre del Sistema:</label>
                        <input type="text" name="nombre_Sistema" id="nombre_Sistema" class="form-control" value="{{ $parametros->nombre_Sistema ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="Administrador">Administrador:</label>
                        <select name="Administrador" id="Administrador" class="form-control">
                            <option value="">-- Seleccionar --</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ (isset($parametros->Administrador) && $parametros->Administrador == $usuario->id) ? 'selected' : '' }}>
                                    {{ $usuario->name }}
                                </option>
                            @endforeach
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Actualizar Parametros</button>
                </form>

            </div>
        </div>
    </section>
</div>



@endsection