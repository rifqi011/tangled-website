<x-admin.app-layout>
    <x-slot name="title">{{ __('Edit Report Status') }}</x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('reports.update', ['type' => $type, 'slug' => $item->slug]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h2 class="text-2xl font-bold">{{ $item->title }}</h2>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple focus:ring-purple">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $item->status === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-6 flex space-x-4">
                            <button type="submit" class="inline-flex items-center rounded-md bg-purple px-4 py-2 text-white">Update Status</button>
                            <a href="{{ route('reports') }}" class="inline-flex items-center rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
