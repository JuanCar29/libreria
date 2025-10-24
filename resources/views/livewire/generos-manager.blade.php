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

    <flux:modal name="genero-modal" class="w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $mode === 'create' ? 'Crear Género' : 'Editar Género' }}</flux:heading>
                <flux:text class="mt-2">Introduce los datos del género</flux:text>
            </div>
            <form wire:submit="save" class="space-y-6">
                <flux:input wire:model="nombre" label="Nombre" />
                <flux:textarea wire:model="descripcion" rows="5" label="Descripción" />
                <flux:spacer />
                <div class="flex justify-end gap-4">
                    <flux:modal.close>
                        <flux:button variant="filled" class="cursor-pointer">Cancelar</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" class="cursor-pointer" size="sm">
                        {{ $mode === 'create' ? 'Guardar' : 'Actualizar' }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</x-caja-principal>
