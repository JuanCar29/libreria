<flux:modal name="libro-modal" class="w-3xl">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $mode ? 'Editar Libro' : 'Crear Libro' }}</flux:heading>
            <flux:text class="mt-2">Introduce los datos del libro</flux:text>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="titulo" label="Título" />
            <flux:input wire:model="autor" label="Autor" />
            <flux:input wire:model="isbn" label="ISBN" />
            <flux:input wire:model="anio_publicacion" label="Año de publicación" />
            <flux:select wire:model="genero_id" label="Género">
                <option value="">Selecciona un género</option>
                @forelse ($this->generos as $genero)
                    <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                @empty
                    <option value="">No hay libros</option>
                @endforelse
            </flux:select>
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
