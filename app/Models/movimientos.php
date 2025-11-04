<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    protected $table = 'movimientos';

    protected $primaryKey = 'id_m';

    protected $fillable = [
        'fecha_m',
        'tipo_m',
        'producto_id',
        'cantidad_m',
        'usuario_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
