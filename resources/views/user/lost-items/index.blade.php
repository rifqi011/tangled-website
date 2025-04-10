<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <div class="flex items-center gap-3">
            <a href="/home">
                <img src="{{ asset('/images/icons/chevron-left.svg') }}" class="aspect-square h-8" alt="chevron left">
            </a>
            <h1 class="text-2xl font-bold">Barang Hilang</h1>
        </div>

        <div class="flex flex-col gap-5">
            @if ($lostItems->isNotEmpty())
                @foreach ($lostItems as $item)
                    <a href="{{ route('lost-items.show', $item->slug ?? '#') }}" class="group flex gap-2 rounded-3xl bg-white shadow-card">
                        <img src="{{ asset($item->photo) }}" class="h-[150px] w-[35%] overflow-hidden rounded-l-3xl bg-gray-200 bg-center object-cover" loading="lazy" alt="{{ $item->title }}">

                        <div class="flex h-full w-2/3 flex-col justify-start p-2 pl-0">
                            <p class="{{ $item->status === 'disimpan' ? 'bg-red' : ($item->status === 'hilang' ? 'bg-purple' : 'bg-green') }} self-start rounded-3xl px-5 text-md capitalize text-white">
                                {{ $item->status }}
                            </p>

                            <h3 class="text-2xl font-semibold mt-2">{{ Str::limit($item->title, 25) }}</h3>

                            <p>Hilang di <strong>{{ $item->last_location }}</strong> pada {{ \Carbon\Carbon::parse($item->lost_date)->locale('id')->translatedFormat('d F Y') }}</p>
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

    {{ $lostItems->links('vendor.pagination.tailwind') }}
</x-user.layout>
