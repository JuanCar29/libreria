<?php

namespace App\Http\Controllers;

use App\Models\Socio;

class SingleController extends Controller
{
    public function showSocio(Socio $socio)
    {
        // 1. Obtener el socio con count y sum (sobre TODOS los préstamos)
        $socio = Socio::withCount('prestamos')
            ->withSum('prestamos', 'sancion')
            ->findOrFail($socio->id);

        // 2. Paginar los préstamos por separado (pero relacionados al socio)
        $prestamos = $socio->prestamos()
            ->orderBy('fecha_prestamo', 'desc')
            ->paginate(5);

        return view('socio-show', compact('socio', 'prestamos'));
    }
}
