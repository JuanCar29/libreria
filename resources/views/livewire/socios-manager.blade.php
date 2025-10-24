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
    <flux:modal name="email-modal" class="w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Email</flux:heading>
                <flux:text class="mt-2">Introduce los datos del email</flux:text>
            </div>
            <form wire:submit="send" class="space-y-6">
                <flux:input wire:model="asunto" label="Asunto" />
                <flux:textarea wire:model="cuerpo" label="Cuerpo" row="5" />
                <flux:spacer />
                <div class="flex justify-end gap-4">
                    <flux:modal.close>
                        <flux:button variant="filled" class="cursor-pointer" size="sm">Cancelar</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" class="cursor-pointer" size="sm">
                        Enviar email
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</x-caja-principal>
