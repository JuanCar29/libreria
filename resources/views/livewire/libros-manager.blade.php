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
                <td @class(['p-4 text-left', 'text-red-600' => $libro->prestado])>{{ $libro->titulo }}</td>
                <td class="p-4 text-left">{{ $libro->genero->nombre }}</td>
                <td class="p-4 text-left">{{ $libro->autor }}</td>
                <td class="p-4">{{ $libro->prestamos_count }}
                <td class="flex items-center justify-center gap-4 p-4">
                    <x-flux::button :href="route('libros.show', $libro)" class="cursor-pointer" icon="eye" size="sm">
                        Ver
                    </x-flux::button>
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

    <x-modales.libro-crud :mode='$mode' />

</x-caja-principal>
