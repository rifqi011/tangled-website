<x-admin.app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create New Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('masterdata.admin.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-admin.input-label for="name" :value="__('Name')" />
                            <x-admin.text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-admin.input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-admin.input-label for="email" :value="__('Email')" />
                            <x-admin.text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required />
                            <x-admin.input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-admin.input-label for="password" :value="__('Password')" />
                            <x-admin.text-input id="password" class="mt-1 block w-full" type="password" name="password" required />
                            <x-admin.input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <a href="{{ route('masterdata.index', ['tab' => 'admins']) }}">
                                <x-admin.danger-button type="button">
                                    Cancel
                                </x-admin.danger-button>
                            </a>

                            <x-admin.primary-button type="submit" class="ml-4">
                                {{ __('Create Admin') }}
                            </x-admin.primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
