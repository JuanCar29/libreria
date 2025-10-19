<?php

namespace App\Livewire;

use App\Models\Prestamo;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class PrestamosHistorial extends Component
{
    use WithPagination;

    public $fecha_devolucion_real;

    public $sancion;

    public $prestamo_id;

    public function rules()
    {
        return [
            'fecha_devolucion_real' => 'nullable|date|after:fecha_prestamo',
            'sancion' => 'nullable|decimal',
        ];
    }

    public function edit(Prestamo $prestamo)
    {
        $this->reset(['fecha_devolucion_real', 'sancion']);
        $this->prestamo_id = $prestamo->id;
        $this->fecha_devolucion_real = $prestamo->fecha_devolucion_real ? $prestamo->fecha_devolucion_real->format('Y-m-d') : null;
        $this->sancion = $prestamo->sancion;
        $this->modal('prestamo-modal')->show();
    }

    public function save()
    {
        if ($this->fecha_devolucion_real === '') {
            $this->fecha_devolucion_real = null;
        }
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;

        $prestamo = Prestamo::find($this->prestamo_id);
        $prestamo->update($validated);
        session()->flash('status', 'Prestamo actualizado correctamente');
        $this->modal('prestamo-modal')->close();
        $this->reset(['fecha_devolucion_real', 'sancion']);
    }

    #[Computed]
    public function prestamos()
    {
        return Prestamo::orderBy('fecha_prestamo')
            ->with('libro', 'socio', 'usuario')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.prestamos-historial');
    }
}
