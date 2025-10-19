<flux:navlist variant="outline">
    <flux:navlist.group :heading="__('Platform')" class="grid">
        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
        <flux:navlist.item icon="tag" :href="route('generos.index')" :current="request()->routeIs('generos.*')" wire:navigate>Generos</flux:navlist.item>
        <flux:navlist.item icon="book-open" :href="route('libros.index')" :current="request()->routeIs('libros.*')" wire:navigate>Libros</flux:navlist.item>
        <flux:navlist.item icon="users" :href="route('socios.index')" :current="request()->routeIs('socios.*')" wire:navigate>Socios</flux:navlist.item>
        <flux:navlist.item icon="calendar" :href="route('prestamos.index')" :current="request()->routeIs('prestamos.index')" wire:navigate>Prestamos</flux:navlist.item>
        <flux:navmenu.separator />
        <flux:navlist.item icon="chart-bar-square" :href="route('prestamos.historial')" :current="request()->routeIs('prestamos.historial')" wire:navigate>Historial</flux:navlist.item>
    </flux:navlist.group>
</flux:navlist>
