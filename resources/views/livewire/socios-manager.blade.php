<div class="w-7xl mx-auto rounded-lg border border-gray-200 bg-white p-4 text-center shadow-sm sm:p-8 dark:border-gray-700 dark:bg-gray-800">

    <x-alerta />

    <div class="mb-4 flex items-center justify-between p-2">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Listado de socios</h5>
        <flux:button wire:click="create" class="cursor-pointer" icon="plus" variant="primary" size="sm">
            Nuevo socio
        </flux:button>
    </div>

    <div class="mb-4 grid grid-cols-1 gap-4 rounded-lg bg-gray-50 p-4 text-black sm:grid-cols-2 lg:grid-cols-3 dark:bg-gray-800 dark:text-white">
        <flux:input wire:model.live.debounce.50ms="buscar_nombre" placeholder="Buscar socio por nombre" clearable />
        <flux:input wire:model.live.debounce.50ms="buscar_telefono" placeholder="Buscar socio por teléfono" clearable />
        <flux:select wire:model.live="buscar_activo">
            <flux:select.option value="">Todos</flux:select.option>
            <flux:select.option value="1">Activos</flux:select.option>
            <flux:select.option value="0">Inactivos</flux:select.option>
        </flux:select>
    </div>

    <x-data-table :headers="['Id', 'Nombre', 'Email', 'Teléfono', 'Prestamos', 'Sanciones', 'Acciones']">
        @forelse ($this->socios as $socio)
            <tr wire:key="socio-{{ $socio->id }}">
                <td class="p-4">
                    {{ $socio->id }}
                </td>
                <td class="p-4 text-left">{{ $socio->nombre }}</td>
                <td class="p-4 text-left">{{ $socio->email }}</td>
                <td class="p-4">{{ $socio->telefono }}</td>
                <td class="p-4">{{ $socio->prestamos_count }}</td>
                <td class="p-4">{{ number_format($socio->prestamos_sum_sancion, 2, ',', '.') }} €</td>
                <td class="p-4">
                    <x-flux::button wire:click="edit('{{ $socio->id }}')" class="cursor-pointer" variant="filled" icon="pencil-square" size="sm">
                        Editar
                    </x-flux::button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-4">No hay socios</td>
            </tr>
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $this->socios->links() }}
    </div>

    <flux:modal name="socio-modal" class="w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $mode ? 'Editar Socio' : 'Crear Socio' }}</flux:heading>
                <flux:text class="mt-2">Introduce los datos del socio</flux:text>
            </div>
            <form wire:submit="save" class="space-y-6">
                <flux:input wire:model="nombre" label="Nombre" />
                <flux:input wire:model="email" label="Email" />
                <flux:input wire:model="telefono" label="Teléfono" />
                <flux:field>
                    <flux:label>Socio activo</flux:label>
                    <flux:switch wire:model.live="activo" />
                </flux:field>
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
</div>
