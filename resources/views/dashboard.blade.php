<x-layouts.app :title="__('Dashboard')" description="Página del panel de control de la aplicación">

    <div class="w-7xl mx-auto rounded-lg border border-gray-200 bg-white p-4 text-center shadow-sm sm:p-8 dark:border-gray-700 dark:bg-gray-800">
        <x-alerta />
        <div class="mb-4 flex items-center justify-between p-2">
            <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Listado de prestamos caducados</h5>

            <form action="{{ route('mandarmails') }}" method="POST">
                @csrf
                <flux:button type="submit" class="cursor-pointer" icon="envelope" variant="primary" size="sm">
                    Mandar notificaciones
                </flux:button>
            </form>
        </div>

        <x-data-table :headers="['Id', 'Libro', 'Socio', 'Fecha prestamo', 'Fecha devolucion', 'Días', 'Fecha notificación']">
            @forelse ($caducados as $caducado)
                <tr wire:key="caducado-{{ $caducado->id }}">
                    <td class="p-4">{{ $caducado->id }}</td>
                    <td class="p-4 text-left">{{ $caducado->libro->titulo }}</td>
                    <td class="p-4 text-left">{{ $caducado->socio->nombre }}</td>
                    <td class="p-4">{{ $caducado->fecha_prestamo->format('d-n-Y') }}</td>
                    <td class="p-4">{{ $caducado->fecha_devolucion->format('d-n-Y') }}</td>
                    <td class="p-4">{{ $caducado->dias_transcurridos }}</td>
                    <td class="p-4">{{ $caducado->fecha_notificacion ? $caducado->fecha_notificacion->format('d-n-Y') : 'Sin notificación' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-4">No hay prestamos caducados.</td>
                </tr>
            @endforelse
        </x-data-table>

        <div class="mt-4">
            {{ $caducados->links() }}
        </div>

    </div>

</x-layouts.app>
