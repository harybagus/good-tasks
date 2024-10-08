<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                        <div class="flex justify-between">
                            <div class="mr-3">
                                {{ __("Welcome ". Auth::user()->name . "! Start adding your to do now.") }}
                            </div>

                            <a href="{{ route('todos.index') }}">
                                <x-primary-button>Add</x-primary-button>
                            </a>
                        </div>
                    @else
                        {{ __("Welcome to GoodToDo! Login now to add your to do.") }}
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
