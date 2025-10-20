<?php

namespace App\Livewire;

use App\Models\Socio;
use Illuminate\Validation\Rule;
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

    public $buscar_nombre;

    public $buscar_telefono;

    public $buscar_activo = '';

    protected function rules()
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('socios', 'nombre')->ignore($this->socio_id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('socios', 'email')->ignore($this->socio_id),
            ],
            'telefono' => ['nullable', 'regex:/^[0-9]{9}$/'],
            'activo' => ['boolean'],
        ];
    }

    public function create()
    {
        $this->reset(['nombre', 'email', 'telefono', 'activo', 'mode']);
        $this->mode = false;
        $this->modal('socio-modal')->show();
    }

    public function edit(Socio $socio)
    {
        $this->reset(['nombre', 'email', 'telefono', 'activo', 'mode']);
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
            ->where('nombre', 'like', '%'.$this->buscar_nombre.'%')
            ->where('telefono', 'like', '%'.$this->buscar_telefono.'%')
            ->when($this->buscar_activo !== '', function ($query) {
                $query->where('activo', $this->buscar_activo);
            })
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
