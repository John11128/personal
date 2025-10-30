<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $query->where('activo', true);
    }

    public function scopeStockBajo($query, $limite = 5)
    {
        return $query->where('stock', '<', $limite);
    }

    /**
     * Accesor para mostrar la ruta completa de la imagen
     */
    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return asset('storage/productos/' . $this->imagen);
        }
        return asset('images/default-product.png'); // Imagen por defecto
    }
}
