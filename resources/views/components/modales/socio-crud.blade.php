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
