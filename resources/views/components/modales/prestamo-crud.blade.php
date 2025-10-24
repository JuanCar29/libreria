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
