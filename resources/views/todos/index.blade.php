<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('ToDos') }}
            </h2>

            <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'modal-add-todo')"
            >{{ __('Add') }}</x-primary-button>

            <x-modal name="modal-add-todo" :show="$errors->isNotEmpty()" focusable>
                <form method="POST" action="{{ route('todos.store') }}" class="p-6">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Add To Do') }}
                    </h2>

                    <div class="mt-6">
                        <x-input-label for="name" value="{{ __('Name') }}" class="sr-only" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-3/4" placeholder="{{ __('Name') }}"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            {{ __('Add') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($todos->count())
                        <x-table>
                            <x-table.thead>
                                <tr>
                                    <x-table.th>#</x-table.th>
                                    <x-table.th>Name</x-table.thbold>
                                    <x-table.th>Status</x-table.th>
                                    <x-table.th>Action</x-table.th>
                                </tr>
                            </x-table.thead>

                            <x-table.tbody>
                                @foreach ($todos as $todo)
                                    <tr>
                                        <x-table.td>{{ $loop->iteration . '.' }}</x-table.td>
                                        <x-table.td>{{ $todo->name }}</x-table.td>
                                        <x-table.td>
                                            @if ($todo->status === "finished")
                                                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-primary-button class="text-xs">{{ $todo->status }}</x-primary-button>
                                                </form>
                                            @else
                                                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-secondary-button type="submit" class="text-xs">{{ $todo->status }}</x-secondary-button>
                                                </form>
                                            @endif
                                        </x-table.td>
                                        <x-table.td>
                                            {{-- <x-secondary-button>
                                                <span class="material-symbols-outlined">
                                                    edit
                                                </span>
                                            </x-secondary-button> --}}

                                            <x-secondary-button
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', `modal-edit-todo-{{ $todo->id }}`)"
                                            ><span class="material-symbols-outlined">
                                                edit
                                            </span></x-secondary-button>

                                            <x-modal name="modal-edit-todo-{{ $todo->id }}" :show="$errors->isNotEmpty()" focusable>
                                                <form method="POST" action="{{ route('todos.update', $todo->id) }}" class="p-6">
                                                    @csrf
                                                    @method('PUT')
                                
                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Edit To Do') }}
                                                    </h2>
                                
                                                    <div class="mt-6">
                                                        <x-input-label for="name" value="{{ __('Name') }}" class="sr-only" />
                                                        <x-text-input id="name" name="name" type="text" value="{{ $todo->name }}" class="mt-1 block w-3/4" placeholder="{{ __('Name') }}"/>
                                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                    </div>
                                
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>
                                
                                                        <x-primary-button class="ms-3">
                                                            {{ __('Edit') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                            </x-modal>

                                            <x-danger-button
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', `modal-delete-todo-{{ $todo->id }}`)"
                                            ><span class="material-symbols-outlined">
                                                delete
                                            </span></x-danger-button>

                                            <x-modal name="modal-delete-todo-{{ $todo->id }}" focusable>
                                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="p-6">
                                                    @csrf
                                                    @method('DELETE')

                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Sure you want to delete the ":name" todo', ['name' => $todo->name]) }}
                                                    </h2>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Delete') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </x-table.td>
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
