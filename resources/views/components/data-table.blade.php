<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-center text-sm text-gray-500 dark:text-gray-400">
        <thead class="bg-gray-50 font-semibold uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="px-6 py-3">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
