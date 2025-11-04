<?php
namespace App\Exports;

use App\Models\Reportes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Reportes::select('id', 'tipo_reporte', 'titulo', 'usuario_id', 'detalles', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Tipo', 'Título', 'Usuario', 'Detalles', 'Fecha'];
    }
}
