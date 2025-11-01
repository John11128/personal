<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $primaryKey = 'id_c';

    protected $fillable = [
        'nombre_c',
        'descripcion_c',
        'activo_c',
        'usuario_id',
    ];

    // Accessors to expose friendly attribute names used by views
    public function getNombreAttribute()
    {
        return $this->attributes['nombre_c'] ?? null;
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_c'] ?? null;
    }

    public function getEstadoAttribute()
    {
        return (bool) ($this->attributes['activo_c'] ?? false);
    }

    /**
     * Relaciones
     */

    // Una categoría tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Productos::class, 'categoria_id');
    }

    // Usuario que creó la categoría
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Scopes útiles
     */
    public function scopeActivas($query)
    {
        return $query->where('activo_c', true);
    }

    public function desactivate()
    {
        $this->activo_c = !$this->activo_c;
        $this->save();
    }   
}
