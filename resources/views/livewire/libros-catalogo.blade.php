<div class="w-7xl mx-auto rounded-lg border border-gray-200 bg-white p-4 text-center shadow-sm sm:p-8 dark:border-gray-700 dark:bg-gray-800">

    <div class="mb-4 flex flex-col gap-2 p-2">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Listado de libros</h5>
        <p>En rojo libros prestados actualmente</p>
    </div>

    <div class="mb-4 grid grid-cols-1 gap-4 rounded-lg bg-gray-50 p-4 text-black lg:grid-cols-3 dark:bg-gray-700 dark:text-white">
        <flux:input wire:model.live.debounce.500ms="buscar_titulo" placeholder="Buscar por título" clearable />
        <flux:input wire:model.live.debounce.500ms="buscar_autor" placeholder="Buscar por autor" clearable />
        <flux:select wire:model.live="buscar_genero">
            <option value="">Selecciona un género</option>
            @forelse($this->generos as $genero)
                <flux:select.option value="{{ $genero->id }}">{{ $genero->nombre }}</flux:select.option>
            @empty
                <flux:select.option value="">No hay géneros</flux:select.option>
            @endforelse
        </flux:select>
    </div>

    <x-data-table :headers="['ISBN', 'Título', 'Genero', 'Autor', 'Nº Prestamos']">
        @forelse ($this->libros as $libro)
            <tr wire:key="libro-{{ $libro->id }}">
                <td class="p-4">
                    {{ $libro->isbn }}
                </td>
                <td @class(['p-4 text-left', 'text-red-600' => $libro->prestado()])>{{ $libro->titulo }}</td>
                <td class="p-4 text-left">{{ $libro->genero->nombre }}</td>
                <td class="p-4 text-left">{{ $libro->autor }}</td>
                <td class="p-4">{{ $libro->prestamos_count }}
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-4">No hay libros</td>
            </tr>
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $this->libros->links() }}
    </div>
</div>
