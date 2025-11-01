@extends('welcome')

@section('contenido')
<div class="content-wrapper mt-4">
    <div class="content-header">
        <h1>Editar Movimiento</h1>
    </div>

    <div class="content">
        <div class="card-body">
            <form action="{{ route('movimientos.update', $movimiento->id_m) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Producto</label>
                    <select name="producto_id" class="form-control" required>
                        @foreach($productos as $p)
                            <option value="{{ $p->id_p }}" {{ $p->id_p == $movimiento->producto_id ? 'selected' : '' }}>
                                {{ $p->nombre_p }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo de Movimiento</label>
                    <select name="tipo_m" class="form-control" required>
                        <option value="Entrada" {{ $movimiento->tipo_m == 'Entrada' ? 'selected' : '' }}>Entrada</option>
                        <option value="Salida" {{ $movimiento->tipo_m == 'Salida' ? 'selected' : '' }}>Salida</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Cantidad</label>
                    <input type="number" name="cantidad_m" class="form-control" value="{{ $movimiento->cantidad_m }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fecha</label>
                    <input type="date" name="fecha_m" class="form-control" value="{{ date('Y-m-d', strtotime($movimiento->fecha_m)) }}" required>
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Actualizar</button>
                    <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
