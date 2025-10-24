<x-caja-principal>

    <x-alerta />

    <x-caja-titulo :title="'Historial de prestamos'">
        <flux:button variant="primary" href="{{ route('prestamos.pdf', ['desde' => $desde, 'hasta' => $hasta]) }}" target="_blank" class="curdor-pointer">
            Descargar PDF
        </flux:button>
    </x-caja-titulo>

    <x-caja-filtros>
        <flux:input wire:model.live="desde" type="date" label="Desde" max="{{ $hasta }}" />
        <flux:input wire:model.live="hasta" type="date" label="Hasta" min="{{ $desde }}" />
        <flux:field>
            <flux:label>Prestamos sin devolver</flux:label>
            <flux:switch wire:model.live="devueltos" />
        </flux:field>
    </x-caja-filtros>

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

    <x-modales.prestamo-editar />

</x-caja-principal>
