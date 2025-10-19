<?php

namespace App\Livewire;

use App\Models\Socio;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class SociosManager extends Component
{
    use WithPagination;

    public $nombre;

    public $email;

    public $telefono;

    public $activo = true;

    public $socio_id = null;

    public $mode;

    protected function rules()
    {
        return [
            'nombre' => 'required|string|max:255|unique:socios,nombre,'.($this->mode ? $this->socio_id : 'NULL').',id',
            'email' => 'required|email|max:255|unique:socios,email,'.($this->mode ? $this->socio_id : 'NULL').',id',
            'telefono' => 'nullable|integer|digits:9',
            'activo' => 'boolean',
        ];
    }

    public function create()
    {
        $this->mode = false;
        $this->reset(['nombre', 'email', 'telefono', 'activo']);
        $this->modal('socio-modal')->show();
    }

    public function edit(Socio $socio)
    {
        $this->mode = true;
        $this->socio_id = $socio->id;
        $this->nombre = $socio->nombre;
        $this->email = $socio->email;
        $this->telefono = $socio->telefono;
        $this->activo = $socio->activo;
        $this->modal('socio-modal')->show();
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->mode) {
            $socio = Socio::find($this->socio_id);
            $socio->update($validated);
            session()->flash('status', 'Socio actualizado correctamente');
        } else {
            Socio::create($validated);
            session()->flash('status', 'Socio creado correctamente');
        }

        $this->modal('socio-modal')->close();
        $this->reset(['nombre', 'email', 'telefono', 'activo', 'mode']);
    }

    #[Computed]
    public function socios()
    {
        return Socio::orderBy('nombre')
            ->withCount('prestamos')
            ->withSum('prestamos', 'sancion')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.socios-manager')
            ->layoutData([
                'title' => 'Socios',
                'description' => 'Listado de socios de la biblioteca municipal',
            ]);
    }
}
