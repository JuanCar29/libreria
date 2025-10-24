<x-caja-principal>

    <x-alerta />

    <x-caja-titulo :title="'Listado de generos literarios'">
        <flux:button wire:click="create" class="cursor-pointer" icon="plus" variant="primary" size="sm">
            Nuevo genero
        </flux:button>
    </x-caja-titulo>

    <x-data-table :headers="['Id', 'Nombre', 'Descripción', 'Nº libros', 'Acciones']">
        @forelse ($this->generos as $genero)
            <tr wire:key="genero-{{ $genero->id }}">
                <td class="p-4">
                    {{ $genero->id }}
                </td>
                <td class="p-4 text-left">{{ $genero->nombre }}</td>
                <td class="p-4 text-left">{{ $genero->descripcion ?? 'Sin descripción' }}</td>
                <td class="p-4">{{ $genero->libros_count }}</td>
                <td class="p-4">
                    <x-flux::button wire:click="edit('{{ $genero->id }}')" class="cursor-pointer" variant="filled" icon="pencil-square" size="sm">
                        Editar
                    </x-flux::button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-4">No hay generos literarios</td>
            </tr>
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $this->generos->links() }}
    </div>

    <x-modales.genero-crud :mode='$mode' />

</x-caja-principal>
