<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre_p ?? '') }}" class="form-control" required>
</div>

<div class="form-group">
    <label>Categoría</label>
    <select name="categoria_id" class="form-control">
        <option value="">-- Seleccionar --</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id_c }}" {{ old('categoria_id', $producto->categoria_id ?? '') == $cat->id_c ? 'selected' : '' }}>
                {{ $cat->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $producto->stock ?? 0) }}" class="form-control" min="0">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Precio Compra</label>
            <input type="number" step="0.01" name="precio_compra" value="{{ old('precio_compra', $producto->precio_compra ?? 0) }}" class="form-control">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Precio Venta</label>
            <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta', $producto->precio_venta ?? 0) }}" class="form-control">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Descripción</label>
    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Imagen</label>
    <input type="file" name="imagen" class="form-control">
    @if(!empty($producto->imagen))
        <div style="margin-top:8px;">
            <img src="{{ asset('storage/'.$producto->imagen) }}" alt="Imagen del producto" width="120" class="img-thumbnail">
        </div>
    @endif
</div>

<div class="text-right">
    <button class="btn btn-success">{{ $modo }}</button>
    <a href="{{ route('productos.index') }}" class="btn btn-default">Cancelar</a>
</div>
