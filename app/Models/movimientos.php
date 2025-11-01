<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class movimientos extends Model
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
}
