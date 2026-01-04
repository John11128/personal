@extends('welcome')


@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
       <h2>Parametros</h2>
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


                <a href="{{ route('Parametros.agregar') }}" class="btn btn-primary mb-3 pull-right">Establecer Parametros</a>
                

                <table class="table table-bordered table-striped">
                
                       <div class="box-body">
                <div class="row"> {{-- Start a row for your columns --}}
                    <div class="col-md-6"> {{-- Left column for description (takes 6 of 12 columns on medium devices and up) --}}
                            {{-- Parametros --}}
                            
                        <h4 class="hidden"><strong>Id Parametro:</strong> {{ $parametros->id_parametro ?? 'N/A' }}</h4>
                        <h4><strong>Nombre del Sistema:</strong> {{ $parametros->nombre_Sistema ?? 'N/A' }}</h4>
                        <h4><strong>Administrador:</strong> {{ $parametros->Administrador ?? 'N/A' }}</h4>
                    </div>

                </div> {{-- End of the row --}}
            </div>
                    
                </table>
                

            </div>
        </div>
    </section>
</div>


@endsection