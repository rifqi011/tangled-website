<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Create Retrieval') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Retrieval for' . ' ' . $item->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="text-green-700 bg-green-100 mb-4 rounded-lg p-4 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="text-red-700 bg-red-100 mb-4 rounded-lg p-4 text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-6 rounded-lg border bg-gray-50 p-4">
                        <h3 class="mb-2 text-lg font-medium text-gray-900">Item Details</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <p class="text-sm text-gray-600">Title</p>
                                <p class="font-medium">{{ $item->title }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Category</p>
                                <p class="font-medium">{{ $item->category->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Found Date</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($item->found_date)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Found Location</p>
                                <p class="font-medium">{{ $item->found_location }}</p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('retrieval.store') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="found_item_id" value="{{ $item->id }}">

                        <!-- Claimant Name -->
                        <div>
                            <x-admin.input-label for="username" :value="__('Claimant Name')" />
                            <x-admin.text-input id="username" class="mt-1 block w-full" type="text" name="username" :value="old('username')" required autofocus />
                            <x-admin.input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-admin.input-label for="userphone" :value="__('Phone Number')" />
                            <x-admin.text-input id="userphone" class="mt-1 block w-full" type="text" name="userphone" :value="old('userphone')" required />
                            <x-admin.input-error :messages="$errors->get('userphone')" class="mt-2" />
                        </div>

                        <!-- Class -->
                        <div class="mt-4">
                            <x-admin.input-label for="class_id" :value="__('Class')" />
                            <select id="class_id" name="class_id" class="mt-1 block w-full rounded-md border py-2 px-4 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-admin.input-error :messages="$errors->get('class_id')" class="mt-2" />
                        </div>

                        <!-- Retrieval Date -->
                        <div class="mt-4">
                            <x-admin.input-label for="retrieval_date" :value="__('Retrieval Date')" />
                            <x-admin.text-input id="retrieval_date" class="mt-1 block w-full" type="date" name="retrieval_date" :value="old('retrieval_date') ?? date('Y-m-d')" />
                            <x-admin.input-error :messages="$errors->get('retrieval_date')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mt-4">
                            <x-admin.input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border py-2 px-4 resize-none border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                            <x-admin.input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <a href="{{ route('retrieval') }}">
                                <x-admin.danger-button type="button">
                                    Cancel
                                </x-admin.danger-button>
                            </a>

                            <x-admin.primary-button type="submit" class="ml-4">
                                {{ __('Create Retrieval') }}
                            </x-admin.primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
