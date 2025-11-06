<x-caja-principal>

    <x-alerta />

    <x-caja-titulo :title="'Listado de socios'">
        <flux:button wire:click="create" class="cursor-pointer" icon="plus" variant="primary" size="sm">
            Nuevo socio
        </flux:button>
    </x-caja-titulo>

    <x-caja-filtros>
        <flux:input wire:model.live.debounce.50ms="buscar_nombre" placeholder="Buscar socio por nombre" clearable />
        <flux:input wire:model.live.debounce.50ms="buscar_telefono" placeholder="Buscar socio por teléfono" clearable />
        <flux:select wire:model.live="buscar_activo">
            <flux:select.option value="">Todos</flux:select.option>
            <flux:select.option value="1">Activos</flux:select.option>
            <flux:select.option value="0">Inactivos</flux:select.option>
        </flux:select>
    </x-caja-filtros>

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
                <td class="flex items-center justify-center gap-4 p-4">
                    <x-flux::button :href="route('socios.show', $socio)" class="cursor-pointer" icon="eye" size="sm">
                        Ver
                    </x-flux::button>
                    <x-flux::button wire:click="edit('{{ $socio->id }}')" class="cursor-pointer" variant="filled" icon="pencil-square" size="sm">
                        Editar
                    </x-flux::button>
                    <x-flux::button wire:click="enviar('{{ $socio->id }}')" class="cursor-pointer" variant="primary" icon="envelope" size="sm">
                        Email
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

    <x-modales.socio-crud :mode='$mode' />

    <x-modales.socio-email />

</x-caja-principal>
