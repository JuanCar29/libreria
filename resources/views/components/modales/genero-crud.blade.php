<flux:modal name="genero-modal" class="w-3xl">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $mode ? 'Editar Género' : 'Nuevo Género' }}</flux:heading>
            <flux:text class="mt-2">Introduce los datos del género</flux:text>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="nombre" label="Nombre" />
            <flux:textarea wire:model="descripcion" rows="5" label="Descripción" />
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
