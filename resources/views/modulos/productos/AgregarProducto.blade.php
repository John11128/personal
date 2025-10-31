@extends('welcome')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Agregar Producto</h1>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevo producto</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('productos.index') }}" class="btn btn-sm btn-default">Volver</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Categoría</label>
                            <select name="categoria_id" class="form-control">
                                <option value="">-- Seleccionar --</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id_c }}" {{ old('categoria_id') == $cat->id_c ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Precio Compra</label>
                                    <input type="number" step="0.01" name="precio_compra" value="{{ old('precio_compra', 0) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Precio Venta</label>
                                    <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta', 0) }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*" onchange="previewImage(event)">
                            <div class="mt-10" id="preview-container" style="display:none; margin-top:10px;">
                                <p class="text-muted">Vista previa:</p>
                                <img id="preview" src="#" alt="Vista previa de imagen" width="150" class="img-thumbnail">
                            </div>
                        </div>

                        <div class="box-footer text-right">
                            <button class="btn btn-primary">Guardar Producto</button>
                            <a href="{{ route('productos.index') }}" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        const container = document.getElementById('preview-container');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                container.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            container.style.display = 'none';
        }
    }
    </script>
@endsection
