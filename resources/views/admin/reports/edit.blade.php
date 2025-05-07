<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Edit Report Status') }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('reports.update', ['type' => $type, 'id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h2 class="text-2xl font-bold">{{ $item->title }}</h2>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="border focus:border-purple focus:ring-purple mt-1 px-4 py-2 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="diproses" {{ $item->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="disimpan" {{ $item->status === 'disimpan' ? 'selected' : '' }}>Disimpan</option>
                                <option value="selesai" {{ $item->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                @if ($type === 'lost')
                                    <option value="hilang" {{ $item->status === 'hilang' ? 'selected' : '' }}>Hilang</option>
                                @endif
                            </select>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-purple inline-flex items-center rounded-md px-4 py-2 text-white">Update Status</button>
                            <a href="{{ route('reports') }}" class="inline-flex items-center rounded-md bg-red px-4 py-2 text-white">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
