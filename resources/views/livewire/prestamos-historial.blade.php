<div class="w-7xl mx-auto rounded-lg border border-gray-200 bg-white p-4 text-center shadow-sm sm:p-8 dark:border-gray-700 dark:bg-gray-800">

    <x-alerta />

    <div class="mb-4 flex items-center justify-between p-2">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Historial de prestamos</h5>
        <flux:button wire:click="pdf" class="cursor-pointer" icon="plus" variant="primary" size="sm">
            Crear PDF
        </flux:button>
    </div>

    <div class="mb-4 grid grid-cols-1 gap-4 rounded-lg bg-gray-50 p-4 text-black lg:grid-cols-3 dark:bg-gray-800 dark:text-white">
        <flux:input wire:model.live="desde" type="date" label="Desde" max="{{ $hasta }}" />
        <flux:input wire:model.live="hasta" type="date" label="Hasta" min="{{ $desde }}" />
        <flux:field>
            <flux:label>Prestamos sin devolver</flux:label>
            <flux:switch wire:model.live="devueltos" />
        </flux:field>
    </div>

    <x-data-table :headers="['Id', 'Libro', 'Socio', 'Fecha prestamo', 'Fecha devolucion', 'Dias prestado', 'Sanción', 'Acciones']">
        @forelse ($this->prestamos as $prestamo)
            <tr wire:key="prestamo-{{ $prestamo->id }}">
                <td class="p-4">
                    {{ $prestamo->id }}
                </td>
                <td class="p-4 text-left">{{ $prestamo->libro->titulo }}</td>
                <td class="p-4 text-left">{{ $prestamo->socio->nombre }}</td>
                <td class="p-4">{{ $prestamo->fecha_prestamo->format('d-n-Y') }}</td>
                <td class="p-4">{{ $prestamo->fecha_devolucion_real ? $prestamo->fecha_devolucion_real->format('d-n-Y') : '-' }}</td>
                <td class="p-4">{{ $prestamo->dias_transcurridos }}</td>
                <td class="p-4">{{ number_format($prestamo->sancion, 2, ',', '.') }} € ({{ $prestamo->dias_sancion }})</td>
                <td class="flex justify-center gap-4 p-4">
                    <x-flux::button wire:click="edit('{{ $prestamo->id }}')" class="cursor-pointer" variant="filled" icon="pencil-square" size="sm">
                        Editar
                    </x-flux::button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="p-4">No hay prestamos</td>
            </tr>
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $this->prestamos->links() }}
    </div>

    <flux:modal name="prestamo-modal" class="w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Editar prestamo</flux:heading>
                <flux:text class="mt-2">Introduce los nuevos datos del prestamo</flux:text>
            </div>
            <form wire:submit="save" class="space-y-6">
                <flux:input wire:model="fecha_devolucion_real" type="date" label="Fecha devolución" />
                <flux:input wire:model="sancion" type="number" step="0.01" label="Sanción" icon:trailing="currency-euro" />
                <flux:spacer />
                <div class="flex justify-end gap-4">
                    <flux:modal.close>
                        <flux:button variant="filled" class="cursor-pointer" size="sm">Cancelar</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" class="cursor-pointer" size="sm">
                        Actualizar
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
