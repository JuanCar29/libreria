<?php

namespace App\Livewire;

use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Socio;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class PrestamosManager extends Component
{
    use WithPagination;

    public $libro_id;

    public $socio_id;

    public $user_id;

    public $fecha_prestamo;

    public $fecha_devolucion;

    public $fecha_devolucion_real;

    public $sancion;

    public $prestamo_id = null;

    public $mode;

    public $dia;

    public $buscar_libro_id;

    public $buscar_socio_id;

    /* public function mount()
    {
        $this->dia = today()->format('Y-m-d');
    } */

    public function rules()
    {
        return [
            'libro_id' => 'required|integer',
            'socio_id' => 'required|integer',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date|after:fecha_prestamo',
            'fecha_devolucion_real' => 'nullable|date|after:fecha_prestamo',
            'sancion' => 'nullable|decimal:0,2',
        ];
    }

    public function create()
    {
        $this->mode = false;
        $this->reset(['libro_id', 'socio_id', 'fecha_prestamo', 'fecha_devolucion', 'fecha_devolucion_real', 'sancion']);
        $this->fecha_prestamo = today()->format('Y-m-d');
        $this->fecha_devolucion = today()->addDays(Prestamo::DIAS)->format('Y-m-d');
        $this->modal('prestamo-modal')->show();
    }

    public function edit(Prestamo $prestamo)
    {
        $this->mode = true;
        $this->reset(['libro_id', 'socio_id', 'fecha_prestamo', 'fecha_devolucion', 'fecha_devolucion_real', 'sancion']);
        $this->prestamo_id = $prestamo->id;
        $this->libro_id = $prestamo->libro_id;
        $this->socio_id = $prestamo->socio_id;
        $this->fecha_prestamo = $prestamo->fecha_prestamo->format('Y-m-d');
        $this->fecha_devolucion = $prestamo->fecha_devolucion->format('Y-m-d');
        $this->modal('prestamo-modal')->show();
    }

    public function save()
    {
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;

        if ($this->mode) {
            $prestamo = Prestamo::find($this->prestamo_id);
            $prestamo->update($validated);
            session()->flash('status', 'Prestamo actualizado correctamente');
        } else {
            Prestamo::create($validated);
            session()->flash('status', 'Prestamo creado correctamente');
        }

        $this->modal('prestamo-modal')->close();
        $this->reset(['libro_id', 'socio_id', 'fecha_prestamo', 'fecha_devolucion', 'fecha_devolucion_real', 'sancion']);
    }

    public function devolver(Prestamo $prestamo)
    {
        $this->fecha_devolucion_real = today()->format('Y-m-d');
        $prestamo->update(['fecha_devolucion_real' => $this->fecha_devolucion_real]);
        if ($prestamo->diasSancion() > 0) {
            $this->sancion = $prestamo->diasSancion() * Prestamo::SANCION;
            $prestamo->update(['sancion' => $this->sancion]);
        }
        session()->flash('status', 'Prestamo devuelto correctamente');
    }

    #[Computed]
    public function prestamos()
    {
        return Prestamo::latest()
            ->when($this->dia, function ($query) {
                $query->whereDate('fecha_prestamo', $this->dia);
            })
            ->when($this->buscar_libro_id, function ($query) {
                $query->where('libro_id', $this->buscar_libro_id);
            })
            ->when($this->buscar_socio_id, function ($query) {
                $query->where('socio_id', $this->buscar_socio_id);
            })
            ->whereNull('fecha_devolucion_real')
            ->with('libro', 'socio', 'usuario')
            ->paginate(10);
    }

    #[Computed]
    public function totalprestamos()
    {
        return Prestamo::whereNull('fecha_devolucion_real')
            ->count();
    }

    #[Computed]
    public function libros()
    {
        $query = Libro::whereDoesntHave('prestamos', function ($query) {
            $query->whereNull('fecha_devolucion_real');
        });
        if ($this->mode && $this->libro_id) {
            $query->orWhere('id', $this->libro_id);
        }

        return $query->orderBy('titulo')->get();
    }

    #[Computed]
    public function socios()
    {
        $query = Socio::whereDoesntHave('prestamos', function ($query) {
            $query->whereNull('fecha_devolucion_real');
        });
        if ($this->mode && $this->socio_id) {
            $query->orWhere('id', $this->socio_id);
        }

        return $query->orderBy('nombre')->get();
    }

    public function render()
    {
        return view('livewire.prestamos-manager')
            ->layoutData([
                'title' => 'Préstamos',
                'description' => 'Listado de préstamos de la biblioteca municipal',
            ]);
    }
}
