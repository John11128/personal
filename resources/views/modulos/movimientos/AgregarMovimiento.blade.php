@extends('welcome')

@section('contenido')
<div class="content-wrapper mt-4">
    <div class="content-header">
        <h1>Agregar Movimiento</h1>
    </div>

    <div class="content">
        <div class="card-body">
            <form action="{{ route('movimientos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Producto</label>
                    <select name="producto_id" class="form-control" required>
                        <option value="">-- Seleccionar producto --</option>
                        @foreach($productos as $p)
                            <option value="{{ $p->id_p }}">{{ $p->nombre_p }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo de Movimiento</label>
                    <select name="tipo_m" class="form-control" required>
                        <option value="Entrada">Entrada</option>
                        <option value="Salida">Salida</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Cantidad</label>
                    <input type="number" name="cantidad_m" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fecha</label>
                    <input type="date" name="fecha_m" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Guardar</button>
                    <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
