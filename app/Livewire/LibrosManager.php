<?php

namespace App\Livewire;

use App\Models\Genero;
use App\Models\Libro;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class LibrosManager extends Component
{
    use WithPagination;

    public $titulo;

    public $autor;

    public $anio_publicacion;

    public $isbn;

    public $genero_id;

    public $mode = false;

    public $libro_id = null;

    public function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'anio_publicacion' => 'required|integer|digits:4',
            'isbn' => 'required|string|max:13|unique:libros,isbn,'.($this->mode ? $this->libro_id : 'NULL').',id',
            'genero_id' => 'required|integer',
        ];
    }

    public function create()
    {
        $this->mode = false;
        $this->reset(['titulo', 'autor', 'anio_publicacion', 'isbn', 'genero_id']);
        $this->modal('libro-modal')->show();
    }

    public function edit(Libro $libro)
    {
        $this->mode = true;
        $this->libro_id = $libro->id;
        $this->titulo = $libro->titulo;
        $this->autor = $libro->autor;
        $this->anio_publicacion = $libro->anio_publicacion;
        $this->isbn = $libro->isbn;
        $this->genero_id = $libro->genero_id;
        $this->modal('libro-modal')->show();
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->mode) {
            $libro = Libro::find($this->libro_id);
            $libro->update($validated);
            session()->flash('status', 'Libro actualizado correctamente');
        } else {
            Libro::create($validated);
            session()->flash('status', 'Libro creado correctamente');
        }

        $this->modal('libro-modal')->close();
        $this->reset(['titulo', 'autor', 'anio_publicacion', 'isbn', 'genero_id', 'mode']);
    }

    #[Computed]
    public function generos()
    {
        return Genero::orderBy('nombre')
            ->get();
    }

    #[Computed]
    public function libros()
    {
        return Libro::orderBy('titulo')
            ->with('genero')
            ->withCount('prestamos')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.libros-manager')
            ->layoutData([
                'title' => 'Libros',
                'description' => 'Listado de libros de la biblioteca municipal',
            ]);
    }
}
