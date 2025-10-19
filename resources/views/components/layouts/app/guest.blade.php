<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <x-menus.principal />

    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar stashable sticky class="border-e border-zinc-200 bg-zinc-50 lg:hidden dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <x-menus.lateral />

    </flux:sidebar>

    {{ $slot }}

    <flux:footer class="flex items-center justify-center bg-zinc-800 p-4 text-white dark:bg-zinc-50 dark:text-zinc-900">
        <p>&copy; {{ now()->format('Y') }} Pcmac desarrollo</p>
    </flux:footer>

    @fluxScripts
</body>

</html>
