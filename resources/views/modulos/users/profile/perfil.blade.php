@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Mi perfil</h3>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                </div>

                <!-- Cambiar contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva contraseña</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Deja en blanco si no deseas cambiarla</small>
                </div>

                <!-- Botón -->
                <button type="submit" class="btn btn-success">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>
@endsection
