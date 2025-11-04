<x-layouts.app :title="'Socio #' . $socio->id" description="Página del socio">

    <x-caja-principal>

        <x-caja-titulo :title="'Listado de prestamos'">
            <x-flux::button :href="route('socios.index')" class="cursor-pointer" icon="arrow-left" variant="primary" size="sm">
                Volver al listado de socios
            </x-flux::button>
        </x-caja-titulo>

        <x-data-table :headers="['Id', 'Libro', 'Fecha prestamo', 'Fecha devolucion', 'Días', 'Sanción']">
            @forelse ($prestamos as $prestamo)
                <tr wire:key="prestamo-{{ $prestamo->id }}">
                    <td class="p-4">{{ $prestamo->id }}</td>
                    <td class="p-4 text-left">{{ $prestamo->libro->titulo }}</td>
                    <td class="p-4">{{ $prestamo->fecha_prestamo->format('d-n-Y') }}</td>
                    <td class="p-4">{{ $prestamo->fecha_devolucion_real ? $prestamo->fecha_devolucion_real->format('d-n-Y') : 'No devuelto' }}</td>
                    <td class="p-4">{{ $prestamo->dias_transcurridos }}</td>
                    <td class="p-4">{{ number_format($prestamo->sancion, 2, ',', '.') }} €</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center">No hay prestamos registrados</td>
                </tr>
            @endforelse
        </x-data-table>

        <div class="mt-4">
            {{ $prestamos->links() }}
        </div>

        <div class="mt-4 flex justify-end gap-4 rounded-lg border border-gray-200 bg-gray-50 p-4 text-right">
            <p><strong>Total de préstamos:</strong> {{ $socio->prestamos_count }}</p>
            <p><strong>Días:</strong> {{ $prestamos->sum('dias_transcurridos') }}</p>
            <p><strong>Sanciones:</strong> {{ $socio->prestamos_sum_sancion > 0 ? number_format($socio->prestamos_sum_sancion, 2, ',', '.') . ' €' : 'sin sanciones' }}</p>
        </div>

    </x-caja-principal>
</x-layouts.app>
