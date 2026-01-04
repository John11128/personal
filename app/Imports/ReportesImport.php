<?php

namespace App\Imports;

use App\Models\Reportes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow; // Importante para saltar el encabezado
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ReportesImport implements ToModel, WithStartRow
{
    /**
     * Le decimos a Laravel-Excel que empiece a leer desde la fila 2.
     * Así ignoramos los títulos y evitamos errores de formato.
     */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Reportes([
            'id_r'       => $row[0], // Corresponde al índice 0 que viste
            'tipo_r'     => $row[1], // Corresponde al índice 1
            'titulo_r'   => $row[2], // Corresponde al índice 2
            'usuario_id' => $row[3], // Corresponde al índice 3
            'detalle_r'  => $row[4], // Corresponde al índice 4
            
            // Tratamiento especial para la fecha del índice 5
            'fecha_r'    => $this->transformarFecha($row[5]),
            
            'created_at' => now(),
        ]);
    }

    /**
     * Función auxiliar para convertir fechas de Excel a formato PHP/SQL
     */
    private function transformarFecha($valor)
    {
        if (is_numeric($valor)) {
            return Date::excelToDateTimeObject($valor);
        }
        
        try {
            return \Carbon\Carbon::parse($valor);
        } catch (\Exception $e) {
            return null; // O un valor por defecto si la fecha viene vacía
        }
    }
}