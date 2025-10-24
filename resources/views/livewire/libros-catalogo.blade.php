<x-caja-principal>

    <x-caja-titulo :title="'Listado de libros'">
        <p>En rojo libros prestados actualmente</p>
    </x-caja-titulo>

    <x-caja-filtros>
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
    </x-caja-filtros>

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

</x-caja-principal>
