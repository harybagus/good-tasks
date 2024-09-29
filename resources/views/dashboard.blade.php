<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($users->count())
                        <x-table>
                            <x-table.thead>
                                <tr>
                                    <x-table.th>#</x-table.th>
                                    <x-table.th>Name</x-table.th>
                                    <x-table.th>Email</x-table.th>
                                    <x-table.th>Created At</x-table.th>
                                </tr>
                            </x-table.thead>

                            <x-table.tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <x-table.td>{{ $loop->iteration . '.' }}</x-table.td>
                                        <x-table.td>{{ $user->name }}</x-table.td>
                                        <x-table.td>{{ $user->email }}</x-table.td>
                                        <x-table.td>{{ $user->created_at->format('d F Y') }}</x-table.td>
                                    </tr>
                                @endforeach
                            </x-table.tbody>
                        </x-table>
                    @else
                        {{ __("You don't have a to do yet.") }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
