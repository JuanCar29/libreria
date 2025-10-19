<?php

namespace App\Livewire;

use App\Models\Genero;
use App\Models\Libro;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class LibrosCatalogo extends Component
{
    use WithPagination;

    public $buscar_titulo;

    public $buscar_genero;

    public $buscar_autor;

    #[Computed]
    public function libros()
    {
        return Libro::orderBy('titulo')
            ->where('titulo', 'like', '%'.$this->buscar_titulo.'%')
            ->where('autor', 'like', '%'.$this->buscar_autor.'%')
            ->when($this->buscar_genero, function ($query) {
                $query->where('genero_id', $this->buscar_genero);
            })
            ->with('genero')
            ->withCount('prestamos')
            ->paginate(25);
    }

    #[Computed]
    public function generos()
    {
        return Genero::orderBy('nombre')
            ->get();
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.libros-catalogo')
            ->layoutData([
                'title' => 'Catálogo de Libros',
                'description' => 'Listado de libros de la biblioteca municipal',
            ]);
    }
}
