@extends('welcome')

@section('contenido')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Categorías</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                
                    <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-success">+ Nueva Categoría</a>
                    <a href="{{ route('categorias.desactivados') }}" class="btn btn-sm btn-default pull-right">Ver Desactivados</a>
                

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
            
            <div class="box-body">
                <livewire:category-table /> 
                
            </div>
        </div>
    </section>
</div>
@endsection