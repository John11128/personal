<?php
namespace App\Exports;

use App\Models\Reportes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Reportes::select('id_r', 'tipo_r', 'titulo_r', 'usuario_id', 'detalle_r', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Tipo', 'Título', 'Usuario', 'Detalles', 'Fecha'];
    }
}
