<x-admin.app-layout>
    <x-slot name="title">
        {{ __('View Report Details') }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">{{ $item->title }}</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="w-full overflow-hidden rounded-3xl bg-center max-w-full object-cover">
                            <img src="{{ asset($item->photo) }}" alt="Item photo">
                        </div>

                        <div>
                            <dl class="grid grid-cols-1 gap-4">
                                @if ($type === 'lost')
                                    <div>
                                        <dt class="font-semibold">Reporter</dt>
                                        <dd>{{ $item->username }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Class</dt>
                                        <dd>{{ $item->class->name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Lost Date</dt>
                                        <dd>{{ $item->lost_date }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Last Location</dt>
                                        <dd>{{ $item->last_location }}</dd>
                                    </div>
                                @else
                                    <div>
                                        <dt class="font-semibold">Found Date</dt>
                                        <dd>{{ $item->found_date }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Found Location</dt>
                                        <dd>{{ $item->found_location }}</dd>
                                    </div>
                                @endif
                                <div>
                                    <dt class="font-semibold">Category</dt>
                                    <dd>{{ $item->category->name }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold">Status</dt>
                                    <dd>
                                        <span class="{{ $item->status === 'diproses' ? 'bg-red' : ($item->status === 'hilang' ? 'bg-purple' : ($item->status === 'disimpan' ? 'bg-blue-600' : 'bg-green')) }} text-white inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                            {{ $item->status }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-semibold">Description</dt>
                                    <dd class="whitespace-pre-wrap">{{ $item->description }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('reports.edit', ['type' => $type, 'id' => $item->id]) }}" class="inline-flex items-center rounded-md bg-purple px-4 py-2 text-white">Edit</a>
                        <a href="{{ route('reports') }}" class="inline-flex items-center rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
