    @extends('welcome')

    @section('contenido')
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
        <h2> Usuarios </h2>
        </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuario"> Crear Usuario </button>
            </div>
        </div>
        
        <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive">
               <thead>
                <tr>
                    <th style="width:10px">#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>foto</th>
                    
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Fecha de Creación</th>
                    <th>Último Acceso</th>
                    <th>Acciones</th>
                </tr>
               </thead>
               
               <tbody>
               @foreach ($usuarios as $key => $user)
                   <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @if ($user->foto != '')
                        <img src="{{ url('storage/'.$user->foto) }}" class="img-thumbnail" width="40px">
                        @else
                        <img src="{{ url('storage/anonymous.png') }}" class="img-thumbnail" width="40px">
                        @endif
                        

                    </td>
                   <td>
                       @if ($user->roll == 'Administrador')
                           <span class="label label-success">Administrador</span>
                       @else
                           <span class="label label-info">Usuario</span>
                       @endif
                  </td>
                  <td>
                       @if ($user->estado == '1')
                           <button class="btn btn-success btn-xs btnEstadoUser" Uid="{{ $user->id }}" estado="0">Activo</button>
                        @else
                            <button class="btn btn-danger btn-xs btnEstadoUser" Uid="{{ $user->id }}" estado="1">Inactivo</button>
                        @endif
                   </td>
                     <td>{{ $user->created_at }}</td>
                        <td>
                            @if ($user->ultimo_login != '')
                             {{ $user->ultimo_login }}
                            @else
                             <span class="label label-danger">Sin Acceso</span>
                            @endif
                     </td>
                     <td>
                        
                            <button class="btn btn-warning btnEditarUsuario" idUsuario="{{ $user->id }}" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btnEliminarUsuario" idUsuario="{{ $user->id }}"><i class="fa fa-trash"></i></button>
                     </td>
                   </tr>
                  
               @endforeach
               

               </tbody>

            </table>


    </section>
    <div class="modal fade" id="modalCrearUsuario">

    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" action="">
                @csrf
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  <h4 class="modal-title"> Crear Usuario </h4> 
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        {{-- Nombre usuario --}}
                        <div class="form-group">
                            <div class="input-group"> 
                            <span class="input-group-addon"> <i class="fa fa-user"></i> </span>

                            <input type="text" class="form-control input-lg" name="name" placeholder="Nombre de Usuario" required>
                            </div>
                        </div>
                        {{-- Email usuario --}}
                        <div class="form-group">

                            <div class="input-group"> 
                            <span class="input-group-addon"> @ </span>

                            <input type="email" class="form-control input-lg" name="email" placeholder="Email del Usuario" required autocomplete="off">
                            </div>
                        </div>
                         @error('email')
                                    <p class="alert alert-danger">El Email ya se encuentra registrado</p>
                                @enderror
                        {{-- Contraseña del Usuario --}}
                        <div class="form-group">

                            <div class="input-group"> 
                            <span class="input-group-addon"> <i class="fa fa-lock"></i> </span>

                            <input type="password" class="form-control input-lg" name="password" placeholder="Clave de Usuario" required autocomplete="new-password">
                            </div>
                        </div>
                        {{-- Elegir Roles de Usuario --}}
                        <div class="form-group">
                            <div class="input-group"> 
                            <span class="input-group-addon"> <i class="fa fa-users"></i> </span>

                            <select class="form-control input-lg selectRol" name="roll" required>
                                <option value="">Seleccionar Rol</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                                        <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                                        <button class="btn btn-primary" type="submit">Crear Usuario</button>
                                </div>

            </form>
        </div>

    </div>

</div>
</div>


<div class="modal fade" id="modalEditarUsuario">

    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" action="{{ url('Actualizar-Usuario') }}">
               @csrf
               @method('put')
                <div class="modal-header" style="background-color: #ffc107; color: black;">
                  <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  <h4 class="modal-title"> Editar Usuario </h4> 
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        {{-- Nombre usuario --}}
                        <div class="form-group">
                            <div class="input-group"> 
                            <span class="input-group-addon"> <i class="fa fa-user"></i> </span>

                            <input type="text" class="form-control input-lg" id="nameEditar" name="name" placeholder="Nombre de Usuario" required>
                            <input type="hidden" class="form-control input-lg" id="idEditar" name="id" placeholder="ID de Usuario" required>
                            </div>
                        </div>
                        {{-- Email usuario --}}
                        <div class="form-group">

                            <div class="input-group"> 
                            <span class="input-group-addon"> @ </span>

                            <input type="email" class="form-control input-lg" id="emailEditar" name="email" placeholder="Email del Usuario" required autocomplete="off">
                            </div>
                        </div>
                         @error('email')
                                    <p class="alert alert-danger">El Email ya se encuentra registrado</p>
                                @enderror
                        {{-- Contraseña del Usuario --}}
                        <div class="form-group">

                            <div class="input-group"> 
                            <span class="input-group-addon"> <i class="fa fa-lock"></i> </span>

                            <input type="password" class="form-control input-lg" id="passwordEditar" name="password" placeholder="Clave de Usuario" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group"> 
                            <span class="input-group-addon"> <i class="fa fa-users"></i> </span>

                            <select class="form-control input-lg selectRol" id="rolEditar" name="roll" required>
                                <option value="">Seleccionar Rol</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                       
                    </div>
                </div>


                <div class="modal-footer">
                                        <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-primary" type="success">Guardar Cambios</button>
                                </div>

            </form>
        </div>

    </div>

</div>



    
@endsection