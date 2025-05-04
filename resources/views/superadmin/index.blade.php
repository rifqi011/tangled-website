<x-app-layout>
    <x-slot name="title">
        {{ __('Kelola Admin') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Kelola Admin') }}
            </h2>
            @if (auth()->user()->isSuperAdmin())
                <x-secondary-button :href="route('admins.create')">
                    Tambah Admin
                </x-secondary-button>
                
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Data Admin') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
