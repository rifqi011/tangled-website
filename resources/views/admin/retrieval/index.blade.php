<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Retrieval') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Retrieval') }}
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
                                <a href="{{ route('retrieval', ['tab' => 'items']) }}" class="{{ $tab === 'items' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    Items
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="{{ route('retrieval', ['tab' => 'history']) }}" class="{{ $tab === 'history' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    History
                                </a>
                            </li>
                        </ul>
                    </div>

                    @if ($tab === 'items')
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
                                                <a href="{{ route('retrieval.show', $item->slug) }}" class="mr-3 text-purple hover:underline">View</a>
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
                    @elseif ($tab === 'history')
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Item
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Retrieved By
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Class
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($retrievals as $retrieval)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $retrieval->foundItem->title }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $retrieval->foundItem->category->name }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ $retrieval->username }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ $retrieval->class->name }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ $retrieval->userphone }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($retrieval->retrieval_date)->format('d M Y') }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <a href="{{ route('reports.show', ['type' => 'found', 'slug' => $retrieval->foundItem->slug]) }}" class="mr-3 text-purple hover:underline">View Item</a>
                                                @if (auth()->user()->isSuperAdmin())
                                                    <button onclick="confirmDelete('{{ $retrieval->id }}')" class="text-red hover:underline">Delete</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm font-medium text-gray-500">
                                                No retrieval records found.
                                            </td>
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
        function confirmDelete(id) {
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
                    fetch(`/retrievals/${id}`, {
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
