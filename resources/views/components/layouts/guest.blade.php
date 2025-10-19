<x-layouts.app.guest :title="$title ?? null" :description="$description ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.guest>
