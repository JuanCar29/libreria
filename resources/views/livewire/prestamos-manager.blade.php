<x-caja-principal>

    <x-alerta />

    <x-caja-titulo :title="'Listado de prestamos ' . $this->totalprestamos()">
        <flux:button wire:click="create" class="cursor-pointer" icon="plus" variant="primary" size="sm">
            Nuevo prestamo
        </flux:button>
    </x-caja-titulo>

    <x-caja-filtros>
        <flux:input wire:model.live="dia" type="date" label="Fecha de prestamo" />
        <flux:input wire:model.live.debounce.500ms="buscar_libro_id" type="text" label="Buscar libro por ID" clearable />
        <flux:input wire:model.live.debounce.500ms="buscar_socio_id" type="text" label="Buscar socio por ID" clearable />
    </x-caja-filtros>

    <x-data-table :headers="['Id', 'Libro', 'Socio', 'Fecha prestamo', 'Fecha devolucion', 'Dias prestado', 'Acciones']">
        @forelse ($this->prestamos as $prestamo)
            <tr wire:key="prestamo-{{ $prestamo->id }}">
                <td class="p-4">
                    {{ $prestamo->id }}
                </td>
                <td class="p-4 text-left">{{ $prestamo->libro->titulo }}</td>
                <td class="p-4 text-left">{{ $prestamo->socio->nombre }}</td>
                <td class="p-4">{{ $prestamo->fecha_prestamo->format('d-n-Y') }}</td>
                <td class="p-4">{{ $prestamo->fecha_devolucion->format('d-n-Y') }}</td>
                <td class="p-4">{{ $prestamo->dias_transcurridos }}</td>
                <td class="flex justify-center gap-4 p-4">
                    <x-flux::button wire:click="edit('{{ $prestamo->id }}')" class="cursor-pointer" variant="filled" icon="pencil-square" size="sm">
                        Editar
                    </x-flux::button>
                    <x-flux::button wire:click="devolver('{{ $prestamo->id }}')" class="cursor-pointer" variant="primary" icon="arrow-down-tray" size="sm">
                        Devolver
                    </x-flux::button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-4">No hay prestamos</td>
            </tr>
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $this->prestamos->links() }}
    </div>

    <flux:modal name="prestamo-modal" class="w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $mode ? 'Editar Prestamo' : 'Crear Prestamo' }}</flux:heading>
                <flux:text class="mt-2">Introduce los datos del prestamo</flux:text>
            </div>
            <form wire:submit="save" class="space-y-6">
                <flux:select wire:model="libro_id" wire:key="libro-{{ $libro_id }}" label="Libro">
                    <flux:select.option value="">Selecciona un libro</flux:select.option>
                    @forelse ($this->libros as $libro)
                        <flux:select.option value="{{ $libro->id }}">{{ $libro->titulo }}</flux:select.option>
                    @empty
                        <flux:select.option value="">No hay libros que prestar</flux:select.option>
                    @endforelse
                </flux:select>
                <flux:select wire:model="socio_id" wire:key="socio-{{ $socio_id }}" label="Socio">
                    <flux:select.option value="">Selecciona un socio</flux:select.option>
                    @forelse ($this->socios as $socio)
                        <flux:select.option value="{{ $socio->id }}">{{ $socio->nombre }}</flux:select.option>
                    @empty
                        <flux:select.option value="">No hay socios</flux:select.option>
                    @endforelse
                </flux:select>
                <flux:input wire:model="fecha_prestamo" type="date" label="Fecha prestamo" />
                <flux:input wire:model="fecha_devolucion" type="date" label="Fecha devolución" />
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


</x-caja-principal>
