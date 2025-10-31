<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id_p';
    protected $fillable = [
        'codigo_p',
        'nombre_p',
        'descripcion_p',
        'categoria_id',
        'stock_p',
        'precio_compra_p',
        'precio_venta_p',
        'imagen_p',
        'activo_p',
        'usuario_id',
    ];

    /**
     * Relaciones
     */

    // Relación con la categoría (muchos productos pertenecen a una categoría)
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    // Relación con el usuario que creó o modificó el producto
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Scopes para filtrar productos
     */
    public function scopeActivos($query)
    {
        return $query->where('activo_p', true);
    }

    public function scopeStockBajo($query, $limite = 5)
    {
        return $query->where('stock_p', '<', $limite);
    }

    /**
     * Accesor para mostrar la ruta completa de la imagen
     */
    public function getImagenUrlAttribute()
    {
        // Devuelve la URL pública de la imagen si existe o una imagen por defecto
        if (!empty($this->imagen_p)) {
            return asset('storage/' . $this->imagen_p);
        }
        // fallback: hay un default.png en storage/app/public
        return asset('storage/default.png');
    }

    /**
     * Accessors to expose friendly attribute names used by the views
     * (so views can use $producto->nombre, $producto->stock, etc.)
     */
    public function getIdAttribute()
    {
        return $this->attributes['id_p'] ?? null;
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_p'] ?? null;
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_p'] ?? null;
    }

    public function getStockAttribute()
    {
        return $this->attributes['stock_p'] ?? 0;
    }

    public function getPrecioCompraAttribute()
    {
        return $this->attributes['precio_compra_p'] ?? 0;
    }

    public function getPrecioVentaAttribute()
    {
        return $this->attributes['precio_venta_p'] ?? 0;
    }

    public function getImagenAttribute()
    {
        return $this->attributes['imagen_p'] ?? null;
    }
}
