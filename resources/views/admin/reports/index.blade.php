<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Report Data Management') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Report Data Management') }}
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
                    <!-- Tab Navigation -->
                    <div class="mb-6 border-b border-gray-200">
                        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium">
                            <li class="mr-2">
                                <a href="{{ route('reports', ['tab' => 'lost']) }}" class="{{ $tab === 'lost' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    Lost Items
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="{{ route('reports', ['tab' => 'found']) }}" class="{{ $tab === 'found' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
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
                                                <span class="{{ $item->status === 'diproses' ? 'bg-blue-600' : ($item->status === 'hilang' ? 'bg-red' : ($item->status === 'disimpan' ? 'bg-purple' : 'bg-green')) }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <a href="{{ route('reports.show', ['type' => 'lost', 'slug' => $item->slug]) }}" class="mr-3 text-purple hover:underline">View</a>
                                                @if (auth()->user()->isSuperAdmin())
                                                    <a href="{{ route('reports.edit', ['type' => 'lost', 'slug' => $item->slug]) }}" class="mr-3 text-blue-600 hover:underline">Edit</a>
                                                    <button onclick="confirmDelete('lost', '{{ $item->slug }}')" class="text-red hover:underline">Delete</button>
                                                @endif
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
                                                <span class="{{ $item->status === 'diproses' ? 'bg-blue-600' : ($item->status === 'disimpan' ? 'bg-purple' : 'bg-green') }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <a href="{{ route('reports.show', ['type' => 'found', 'slug' => $item->slug]) }}" class="mr-3 text-purple hover:underline">View</a>
                                                @if (auth()->user()->isSuperAdmin())
                                                    <a href="{{ route('reports.edit', ['type' => 'found', 'slug' => $item->slug]) }}" class="mr-3 text-blue-600 hover:underline">Edit</a>
                                                    <button onclick="confirmDelete('found', '{{ $item->slug }}')" class="text-red hover:underline">Delete</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">No found items found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(type, slug) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/reports/${type}/${slug}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Deleted!', 'Report has been deleted.', 'success')
                                    .then(() => location.reload());
                            }
                        });
                }
            });
        }
    </script>
</x-admin.app-layout>
