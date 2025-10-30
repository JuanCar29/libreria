<flux:navbar class="-mb-px max-lg:hidden">
    <flux:navbar.item :href="route('home')" icon="home" :current="request()->routeIs('home')">Home</flux:navbar.item>
    <flux:navbar.item :href="route('libros.catalogo')" icon="book-open" :current="request()->routeIs('libros.catalogo')">Libros</flux:navbar.item>
    @auth
        <flux:navbar.item :href="route('dashboard')" icon="user-circle" :current="request()->routeIs('dashboard')">Mi cuenta</flux:navbar.item>
    @else
        <flux:navbar.item :href="route('login')" icon="arrow-right-end-on-rectangle" :current="request()->routeIs('login')">Acceso</flux:navbar.item>
    @endauth
</flux:navbar>
