<x-layout>
    <div class="relative left-0 top-0 mb-3 items-center justify-center bg-white bg-clip-content pb-5 pt-3">
        <div class="flex w-full items-center justify-between gap-4">
            <form method="GET" action="{{ route('search.index') }}" class="flex w-full items-center gap-3 rounded-3xl border-2 border-black px-3 py-1">
                <img src="{{ asset('images/icons/search.svg') }}" alt="icon" class="w-6">

                <input type="search" name="query" id="search" value="{{ request('query') }}" class="w-full text-xl placeholder-black outline-none" autocomplete="off" autofocus placeholder="Nyari sesuatu?">

                <input type="hidden" name="category" id="category_id" value="{{ request('category', 'Semua') }}">
            </form>

            <div id="filter-button" class="group flex h-full cursor-pointer flex-col items-center gap-2">
                <span id="top-bar" class="h-1 w-10 bg-black transition-all duration-200"></span>
                <span id="middle-bar" class="h-1 w-7 bg-black transition-all duration-200"></span>
                <span id="bottom-bar" class="h-1 w-4 bg-black transition-all duration-200"></span>
            </div>
        </div>

        <div id="filter-modal" class="absolute -translate-y-[160%] rounded-3xl bg-white p-3 pb-4 shadow-card transition-all duration-300 ease-out">
            <div class="w-full space-y-3">
                <h3 class="text-xl">Kata kunci:</h3>
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="category-btn py-1/2 {{ request('category', 'Semua') === 'Semua' ? '!bg-purple !text-white' : '!bg-gray-100 !text-black' }} rounded-3xl border border-gray-500 px-3 text-xl !transition-all hover:bg-gray-200 focus:outline-none" data-id="Semua">
                        Semua
                    </button>

                    @foreach ($categories as $category)
                        <button type="button" class="category-btn py-1/2 {{ request('category') === $category->name ? '!bg-purple !text-white' : '!bg-gray-100 !text-black' }} rounded-3xl border border-gray-500 px-3 text-xl !transition-all hover:bg-gray-200 focus:outline-none" data-id="{{ $category->name }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- List barang --}}
    <div class="mb-8 flex flex-col gap-3">
        @if ($items->count() > 0)
            @foreach ($items as $item)
                <a href="{{ route($item->type . '-items.show', $item->slug ?? '#') }}" class="group flex gap-2 rounded-3xl bg-white shadow-card">
                    <img src="{{ asset($item->photo) }}" class="min-h-[180px] w-[35%] overflow-hidden rounded-l-3xl bg-gray-200 bg-center object-cover" loading="lazy" alt="{{ $item->title }}">

                    <div class="flex h-full w-2/3 flex-col justify-start gap-3 p-2 pl-0">
                        <p class="{{ $item->status === 'disimpan' ? 'bg-red' : ($item->status === 'hilang' ? 'bg-purple' : 'bg-green') }} self-start rounded-3xl px-5 text-lg capitalize text-white">
                            {{ $item->status }}
                        </p>

                        <h3 class="text-2xl font-semibold">{{ Str::limit($item->title, 25) }}</h3>

                        @if ($item->type === 'found')
                            <p>Ditemukan di <strong>{{ $item->location }}</strong> pada {{ \Carbon\Carbon::parse($item->date)->locale('id')->translatedFormat('d F Y') }}</p>
                        @else
                            <p>Hilang di <strong>{{ $item->location }}</strong> pada {{ \Carbon\Carbon::parse($item->date)->locale('id')->translatedFormat('d F Y') }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        @else
            <div class="py-10 text-center text-xl">
                <img src="{{ asset('images/search-not-found.png') }}" alt="">

                <p class="text-2xl font-semibold">Coba gunakan kata kunci lainnya atau buat laporan kehilangan</p>

                <x-button href="lost" class="mt-6">Buat laporan</x-button>
            </div>
        @endif
    </div>
</x-layout>
