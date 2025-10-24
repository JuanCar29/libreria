<flux:modal name="email-modal" class="w-3xl">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Email</flux:heading>
            <flux:text class="mt-2">Introduce los datos del email</flux:text>
        </div>
        <form wire:submit="send" class="space-y-6">
            <flux:input wire:model="asunto" label="Asunto" />
            <flux:textarea wire:model="cuerpo" label="Cuerpo" row="5" />
            <flux:spacer />
            <div class="flex justify-end gap-4">
                <flux:modal.close>
                    <flux:button variant="filled" class="cursor-pointer" size="sm">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" class="cursor-pointer" size="sm">
                    Enviar email
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>
