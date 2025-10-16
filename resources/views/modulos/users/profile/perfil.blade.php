@extends('welcome')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h2> Gestor de Perfil </h2>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <form method="POST" action="{{ url('/perfil') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                                <input type="text" class="form-control input-lg" name="name" required value="{{ Auth::user()->name }}"
                                    placeholder="Nombre Completo">
                            </div>
                        </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                                    <input type="email" class="form-control input-lg" name="email" required value="{{ Auth::user()->email }}"
                                        placeholder="Correo Electrónico">
                                </div>
                                @error('email')
                                    <p class="alert alert-danger">El Email ya se encuentra registrado</p>
                                @enderror
                            </div>
                              <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-lock"></i> </span>
                                <input type="password" class="form-control input-lg" name="password" placeholder="Nueva contraseña (opcional)" autocomplete="new-password">
                                <input type="password" class="form-control input-lg" name="password_confirmation" placeholder="Confirmar contraseña">
                               
                            </div>
                        </div>

                        <div class="form-group">
                                <input type="file" class="form-control input-lg" name="foto">
                                <br>
                                @if (auth()->user()->foto != "")
                                  <img src="{{ url('storage/'.Auth()->user()->foto) }}" width="100px" height="100px"
                                    class="img-thumbnail previsualizar" alt="">
                                    @else
                                      <img src="{{ url('storage/anonymous.png') }}" width="100px" height="100px"
                                    class="img-thumbnail previsualizar" alt="">
                                @endif
                              
                            </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Actualizar Datos</button>
                            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection