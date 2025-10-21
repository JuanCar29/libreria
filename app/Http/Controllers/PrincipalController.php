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

    public function mandarMails()
    {
        $prestamos = Prestamo::where('fecha_devolucion', '<', today())
            ->where(function ($query) {
                $query->whereNull('fecha_notificacion')
                    ->orWhere('fecha_notificacion', '<', today()->addDays(3));
            })
            ->with(['libro', 'socio'])
            ->get();

        if ($prestamos->isEmpty()) {
            session()->flash('danger', 'No hay notificaciones para enviar.');

            return redirect()->route('dashboard');
        }

        foreach ($prestamos as $prestamo) {
            $prestamo->socio->notify(new PrestamoCaducado);
            $prestamo->update(['fecha_notificacion' => today()]);
        }

        session()->flash('status', 'Notificaciones enviadas con éxito.');

        return redirect()->route('dashboard');
    }
}
