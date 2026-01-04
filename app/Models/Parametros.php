<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametros extends Model
{
    /** @use HasFactory<\Database\Factories\ParametrosFactory> */
    use HasFactory;
    protected $table = 'parametros';
    protected $primaryKey = 'id_parametro';
    public $timestamps = false;
    protected $fillable = [
        'nombre_Sistema',
        'Administrador',
    ];

    public static function getGlobal()
    {
        return self::first();
    }

    public function administrador()
    {
        return $this->belongsTo(User::class, 'Administrador');
    }
}
