<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Carbon\Carbon;
use Illuminate\Http\Request; // Usa el facade de DomPDF
use PDF;

class PrestamosPdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        // Validar y obtener fechas
        $desde = $request->query('desde', today()->startOfMonth()->toDateString());
        $hasta = $request->query('hasta', today()->endOfMonth()->toDateString());

        $startDate = Carbon::parse($desde);
        $endDate = Carbon::parse($hasta);

        // Validación básica
        if ($endDate->lt($startDate)) {
            abort(400, 'La fecha "hasta" no puede ser anterior a la fecha "desde".');
        }

        // Obtener los préstamos del rango
        $prestamos = Prestamo::with(['libro', 'socio'])
            ->whereBetween('fecha_prestamo', [$startDate, $endDate])
            ->orderBy('fecha_prestamo')
            ->get();

        // Dividir en páginas de 30 registros
        $loanPages = $prestamos->chunk(30);

        // Cargar la vista del PDF
        $pdf = PDF::loadView('pdf.prestamos', [
            'loanPages' => $loanPages,
            'desde' => $startDate->toDateString(),
            'hasta' => $endDate->toDateString(),
        ]);

        // Stream del PDF (para mostrarlo en el navegador)
        return $pdf->stream("prestamos_{$desde}_{$hasta}.pdf");
    }
}
