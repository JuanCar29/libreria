<flux:navlist class="w-48">
    <flux:navlist.item :href="route('home')" icon="home" :current="request()->routeIs('home')">Home</flux:navlist.item>
    <flux:navlist.item :href="route('libros.catalogo')" icon="book-open" :current="request()->routeIs('libros.catalogo')">Libros</flux:navlist.item>
    @auth
        <flux:navlist.item :href="route('dashboard')" icon="user-circle" :current="request()->routeIs('dashboard')">Mi cuenta</flux:navlist.item>
    @else
        <flux:navlist.item :href="route('login')" icon="arrow-right-end-on-rectangle" :current="request()->routeIs('login')">Acceso</flux:navlist.item>
    @endauth
</flux:navlist>
