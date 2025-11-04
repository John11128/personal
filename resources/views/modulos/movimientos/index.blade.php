@extends('welcome')

@section('contenido')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Movimientos</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Listado de Movimientos</h3>
            </div>
            <div class="box-body">
                <a href="{{ route('movimientos.create') }}" class="btn btn-success btn-sm">+ Nuevo Movimiento</a>

                </div>

            <livewire:movement-table />
            
        </div>
    </section>
</div>
@endsection