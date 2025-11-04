<?php
namespace App\Imports;

use App\Models\Reportes;
use Maatwebsite\Excel\Concerns\ToModel;

class ReportesImport implements ToModel
{
    public function model(array $row)
    {
        return new Reportes([
            'tipo_reporte' => $row[1],
            'titulo' => $row[2],
            'usuario_id' => $row[3],
            'detalles' => $row[4],
            'created_at' => now(),
        ]);
    }
}
