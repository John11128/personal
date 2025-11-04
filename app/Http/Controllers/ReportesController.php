<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reportes;
use App\Models\User;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Movimientos;
use PDF;
use Excel;

class ReportesController extends Controller
{
   
    public function index()
    {
        $reportes = Reportes::with('usuario')->orderBy('fecha_r', 'desc')->paginate(20);
        return view('modulos.reportes.index', compact('reportes'));
    }

    //Exportar a Excel
    public function exportExcel()
    {
      return Excel::download(new \App\Exports\ReportesExport, 'reportes.xlsx');
    }
    //Exportar a PDF
    public function exportPDF()
    {
        $reportes = Reportes::latest()->get();
        $pdf = PDF::loadView('reportes.pdf', compact('reportes'));
        return $pdf->download('reportes.pdf');
    }
     // 🔼 Importar desde Excel
    public function importExcel(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new \App\Imports\ReportesImport, $request->file('archivo'));

        return back()->with('success', 'Datos importados correctamente.');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
