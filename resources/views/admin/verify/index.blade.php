<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Report Data Management') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col items-center justify-between sm:flex-row">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Report Data Management') }}
                </h2>
            </div>

            <x-admin.search-form route="verify" :searchTerm="$search" placeholder="Search {{ $tab === 'lost' ? 'lost' : 'found' }} items..." :hiddenInputs="['tab' => $tab]" />
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
                    <!-- Tab Navigation -->
                    <div class="mb-6 border-b border-gray-200">
                        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium">
                            <li class="mr-2">
                                <a href="{{ route('verify', ['tab' => 'lost']) }}" class="{{ $tab === 'lost' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    Lost Items
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="{{ route('verify', ['tab' => 'found']) }}" class="{{ $tab === 'found' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    Found Items
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    @if ($tab === 'lost')
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
                                                <span class="{{ $item->status === 'diproses' ? 'bg-blue-600' : 'bg-green' }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <a href="{{ route('verify.show', ['type' => 'lost', 'slug' => $item->slug]) }}" class="mr-3 text-purple hover:underline">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">No lost items found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-4 px-4 py-3 sm:px-6">
                                {{ $lostItems->links() }}
                            </div>
                        </div>
                    @elseif ($tab === 'found')
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Found Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Location</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($foundItems as $item)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->category->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->found_date }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->found_location }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-white">
                                                <span class="{{ $item->status === 'diproses' ? 'bg-blue-600' : 'bg-green' }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <a href="{{ route('verify.show', ['type' => 'found', 'slug' => $item->slug]) }}" class="mr-3 text-purple hover:underline">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">No found items found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-4 px-4 py-3 sm:px-6">
                                {{ $foundItems->links() }}
                            </div>
                        </div>
                    @endif

                    <!-- Search Results Status -->
                    @if ($search)
                        <div class="mt-4 text-sm text-gray-500">
                            @if ($tab === 'lost')
                                {{ $lostItems->total() }} results found for "{{ $search }}" in lost items
                                <a href="{{ route('verify', ['tab' => 'lost']) }}" class="ml-2 text-purple hover:underline">Clear search</a>
                            @else
                                {{ $foundItems->total() }} results found for "{{ $search }}" in found items
                                <a href="{{ route('verify', ['tab' => 'found']) }}" class="ml-2 text-purple hover:underline">Clear search</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
