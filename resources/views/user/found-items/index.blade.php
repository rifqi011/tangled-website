<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <div class="flex gap-3 items-center">
            <a href="/home">
                <img src="{{ asset('/images/icons/chevron-left.svg') }}" class="aspect-square h-8" alt="chevron left">
            </a>
            <h1 class="text-2xl font-bold">Barang Temuan</h1>
        </div>

        <div class="flex flex-col gap-5">
            @if ($foundItems->isNotEmpty())
                @foreach ($foundItems as $item)
                    <a href="{{ route('found-items.show', $item->slug ?? '#') }}" class="group flex gap-2 rounded-3xl bg-white shadow-card">
                        <img src="{{ asset($item->photo) }}" class="h-[150px] w-[35%] overflow-hidden rounded-l-3xl bg-gray-200 bg-center object-cover" loading="lazy" alt="{{ $item->title }}">

                        <div class="flex h-full w-2/3 flex-col justify-start p-2 pl-0">
                            <p class="self-start rounded-3xl px-5 text-md capitalize text-white {{ $item->status === 'disimpan' ? 'bg-red' : 'bg-green' }}">
                                {{ $item->status }}
                            </p>

                            <h3 class="text-2xl font-semibold mt-2">{{ Str::limit($item->title, 25) }}</h3>

                            <p>Ditemukan di <strong>{{ $item->found_location }}</strong> pada {{ \Carbon\Carbon::parse($item->found_date)->locale('id')->translatedFormat('d F Y') }}</p>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="flex flex-col items-center gap-8">
                    <img src="{{ asset('images/error.png') }}" class="w-2/3" loading="lazy" alt="error picture">
                    <h1 class="text-center text-3xl font-bold">Tidak ada barang untuk ditampilkan</h1>
                </div>
            @endif
        </div>
    </div>

    {{ $foundItems->links('vendor.pagination.tailwind') }}
</x-user.layout>
