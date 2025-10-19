<x-layouts.guest title="Página principal" description="Página principal de la aplicación">
    <div class="container mx-auto flex h-full flex-col items-center justify-center space-y-4">
        <h1 class="text-3xl font-bold">{{ config('app.name') }}</h1>
        <p class="text-xl">Bienvenido a la página principal de la aplicación.</p>
        <p class="text-xl">{{ ucwords(now()->translatedFormat('l, j F Y')) }}</p>
        <p class="text-xl">{{ now()->format('H:i') }}</p>
    </div>
</x-layouts.guest>
