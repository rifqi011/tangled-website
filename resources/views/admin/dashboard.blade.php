<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
                <x-admin.dashboard-card title="Unverified Reports" :value="$totalUnverifiedReports" :route="route('verify')" />
                <x-admin.dashboard-card title="Total Reports" :value="$totalReports" :route="route('reports')" />
                <x-admin.dashboard-card title="Retrieval Items" :value="$totalRetrievals" :route="route('retrieval')" />
                <x-admin.dashboard-card title="Lost Items Found" :value="$totalLostItemsFound" :route="route('lost-item-found')" />
            </div>

            <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
                {{-- Recent Lost Items --}}
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-3 p-6 text-gray-900">
                        <h2 class="text-xl font-medium">Recent Lost Items</h2>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Reporter</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Lost Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($recentLostItems as $item)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->username }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->lost_date }}</td>
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

                {{-- Recent Found Items --}}
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-3 p-6 text-gray-900">
                        <h2 class="text-xl font-medium">Recent Found Items</h2>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Location</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Lost Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($recentFoundItems as $item)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->found_location }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->found_date }}</td>
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

                {{-- Top 5 Classes --}}
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-3 p-6 text-gray-900">
                        <h2 class="text-xl font-medium">Most Reporting Class</h2>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Total</th>
                                        @if (auth()->user()->isSuperAdmin())
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($topClassesLost as $item)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $item->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->total }}</td>
                                            @if (auth()->user()->isSuperAdmin())
                                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                    <a href="{{ route('masterdata.index', ['tab' => 'classes']) }}" class="mr-3 text-purple hover:underline">View</a>
                                                </td>
                                            @endif
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

                {{-- Top 5 Category --}}
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-3 p-6 text-gray-900">
                        <h2 class="text-xl font-medium">Most Reported Category</h2>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Total</th>
                                        @if (auth()->user()->isSuperAdmin())
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($topCategoriesReported as $item)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $item->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $item->report_count }}</td>
                                            @if (auth()->user()->isSuperAdmin())
                                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                    <a href="{{ route('masterdata.index', ['tab' => 'categories']) }}" class="mr-3 text-purple hover:underline">View</a>
                                                </td>
                                            @endif
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
    </div>
</x-admin.app-layout>
