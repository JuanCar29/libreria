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
