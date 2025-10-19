@if (session('status'))
    <flux:callout icon="bell-alert" variant="success" inline x-data="{ visible: true }" x-show="visible" x-init="setTimeout(() => visible = false, 3000)" class="mb-4">
        <flux:callout.heading class="@max-md:flex-col flex items-start gap-2">{{ session('status') }}</flux:callout.heading>
        <x-slot name="controls">
            <flux:button icon="x-mark" variant="ghost" x-on:click="visible = false" />
        </x-slot>
    </flux:callout>
@endif
