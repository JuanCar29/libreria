<x-caja-principal>

    <x-alerta />

    <x-caja-titulo :title="'Listado de libros'">
        <flux:button wire:click="create" class="cursor-pointer" icon="plus" variant="primary" size="sm">
            Nuevo libro
        </flux:button>
    </x-caja-titulo>

    <x-caja-filtros>
        <flux:input wire:model.live.debounce.500ms="buscar_titulo" placeholder="Buscar por título" clearable />
        <flux:select wire:model.live="buscar_genero">
            <option value="">Selecciona un género</option>
            @forelse($this->generos as $genero)
                <flux:select.option value="{{ $genero->id }}">{{ $genero->nombre }}</flux:select.option>
            @empty
                <flux:select.option value="">No hay géneros</flux:select.option>
            @endforelse
        </flux:select>
    </x-caja-filtros>

    <x-data-table :headers="['Id', 'Título', 'Genero', 'Autor', 'Prestamos', 'Acciones']">
        @forelse ($this->libros as $libro)
            <tr wire:key="libro-prestamo-{{ $libro->id }}">
                <td class="p-4">
                    {{ $libro->id }}
                </td>
                <td @class(['p-4 text-left', 'text-red-600' => $libro->prestado()])>{{ $libro->titulo }}</td>
                <td class="p-4 text-left">{{ $libro->genero->nombre }}</td>
                <td class="p-4 text-left">{{ $libro->autor }}</td>
                <td class="p-4">{{ $libro->prestamos_count }}
                <td class="p-4">
                    <x-flux::button wire:click="edit('{{ $libro->id }}')" class="cursor-pointer" variant="filled" icon="pencil-square" size="sm">
                        Editar
                    </x-flux::button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="p-4">No hay libros</td>
            </tr>
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $this->libros->links() }}
    </div>

    <flux:modal name="libro-modal" class="w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $mode ? 'Editar Libro' : 'Crear Libro' }}</flux:heading>
                <flux:text class="mt-2">Introduce los datos del libro</flux:text>
            </div>
            <form wire:submit="save" class="space-y-6">
                <flux:input wire:model="titulo" label="Título" />
                <flux:input wire:model="autor" label="Autor" />
                <flux:input wire:model="isbn" label="ISBN" />
                <flux:input wire:model="anio_publicacion" label="Año de publicación" />
                <flux:select wire:model="genero_id" label="Género">
                    <option value="">Selecciona un género</option>
                    @forelse ($this->generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                    @empty
                        <option value="">No hay libros</option>
                    @endforelse
                </flux:select>
                <flux:spacer />
                <div class="flex justify-end gap-4">
                    <flux:modal.close>
                        <flux:button variant="filled" class="cursor-pointer" size="sm">Cancelar</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" class="cursor-pointer" size="sm">
                        {{ $mode ? 'Actualizar' : 'Guardar' }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

</x-caja-principal>
