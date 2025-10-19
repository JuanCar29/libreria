<div class="w-7xl mx-auto rounded-lg border border-gray-200 bg-white p-4 text-center shadow-sm sm:p-8 dark:border-gray-700 dark:bg-gray-800">

    <x-alerta />

    <div class="mb-4 flex items-center justify-between p-2">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Listado de libros</h5>
        <flux:button wire:click="create" class="cursor-pointer" icon="plus" variant="primary" size="sm">
            Nuevo libro
        </flux:button>
    </div>

    <x-data-table :headers="['Id', 'Título', 'Genero', 'Autor', 'Prestamos', 'Acciones']">
        @forelse ($this->libros as $libro)
            <tr wire:key="libro-{{ $libro->id }}">
                <td class="p-4">
                    {{ $libro->id }}
                </td>
                <td class="p-4 text-left">{{ $libro->titulo }}</td>
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
                        <flux:button variant="filled" class="cursor-pointer">Cancelar</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" class="cursor-pointer" size="sm">
                        {{ $mode ? 'Actualizar' : 'Guardar' }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
