<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Lost Items Found') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Lost Items Found') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="relative mb-4 rounded border bg-green px-4 py-3 text-white" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Reporter</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Class</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($lostItems as $item)
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->username }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->class->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->lost_date }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-white">
                                            <span class="{{ $item->status === 'hilang' ? 'bg-purple' : 'bg-red' }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                            <a href="{{ route('lost-item-found.show', $item->slug) }}" class="mr-3 text-purple hover:underline">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">No lost items found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
