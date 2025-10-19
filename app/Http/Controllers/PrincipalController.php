<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;

class PrincipalController extends Controller
{
    public function caducados()
    {
        $caducados = Prestamo::where('fecha_devolucion', '<', today())
            ->orderBy('fecha_devolucion', 'desc')
            ->with(['libro', 'socio'])
            ->paginate(10);

        return view('dashboard', compact('caducados'));
    }
}
