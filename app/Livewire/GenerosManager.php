<?php

namespace App\Livewire;

use App\Models\Genero;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class GenerosManager extends Component
{
    use WithPagination;

    public $nombre;

    public $descripcion;

    public $genero_id = null;

    public $mode;

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255|unique:generos,nombre,'.($this->mode ? $this->genero_id : 'NULL').',id',
            'descripcion' => 'nullable|string|max:1000',
        ];
    }

    public function create()
    {
        $this->mode = false;
        $this->reset(['nombre', 'descripcion']);
        $this->modal('genero-modal')->show();
    }

    public function edit(Genero $genero)
    {
        $this->mode = true;
        $this->genero_id = $genero->id;
        $this->nombre = $genero->nombre;
        $this->descripcion = $genero->descripcion;
        $this->modal('genero-modal')->show();
    }

    public function save()
    {
        $this->validate();

        if ($this->mode) {
            $genero = Genero::find($this->genero_id);
            $genero->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);
            session()->flash('status', 'Genero actualizado correctamente');
        } else {
            Genero::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);
            session()->flash('status', 'Genero creado correctamente');
        }

        $this->modal('genero-modal')->close();
        $this->reset(['nombre', 'descripcion', 'mode']);

    }

    #[Computed]
    public function generos()
    {
        return Genero::orderBy('nombre')
            ->withCount('libros')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.generos-manager')
            ->layoutData([
                'title' => 'Géneros',
                'description' => 'Listado de géneros de la biblioteca municipal',
            ]);
    }
}
