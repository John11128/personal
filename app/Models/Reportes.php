<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reportes extends Model
{
    protected $table = 'reportes';
    protected $primaryKey = 'id_r';

    protected $fillable = [
        'tipo_r',
        'titulo_r',
        'descripcion_r',
        'detalle_r',
        'usuario_id',
        'fecha_r',
    ];

    protected $casts = [
        'detalle_r' => 'array',
        'fecha_r' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
