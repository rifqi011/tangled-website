<x-app-layout>
    <x-slot name="title">
        {{ __('Admin Management') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Admin Management') }}
            </h2>
            @if (auth()->user()->isSuperAdmin())
                <a href="{{ route('admins.create') }}"">
                    <x-secondary-button>
                        Create Admin
                    </x-secondary-button>
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green text-white relative mb-4 rounded border px-4 py-3" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-2 p-6 text-gray-900">
                    {{ __('Data Admin') }}

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $admin->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $admin->email }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $admin->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                            <div class="flex space-x-2">
                                                {{-- @can('update', $admin) --}}
                                                <a href="{{ route('admins.edit', $admin) }}" class="text-purple hover:underline">
                                                    Edit
                                                </a>
                                                {{-- @endcan --}}

                                                {{-- @can('delete', $admin) --}}
                                                <form action="{{ route('admins.destroy', $admin) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red hover:underline">
                                                        Delete
                                                    </button>
                                                </form>
                                                {{-- @endcan --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">
                                            No admin users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
