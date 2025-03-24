<x-layout>
    <div class="relative left-0 top-0 mb-3 items-center justify-center bg-white bg-clip-content pb-5 pt-3">
        <div class="flex w-full items-center justify-between gap-4">
            <form class="flex w-full items-center gap-3 rounded-3xl border-2 border-black px-3 py-1">
                <img src="{{ asset('images/icons/search.svg') }}" alt="icon" class="w-6">

                <input type="search" name="search" id="search" class="w-full text-xl placeholder-black outline-none" autocomplete="off" autofocus placeholder="Nyari sesuatu?">
            </form>

            <div id="filter-button" class="group flex h-full cursor-pointer flex-col items-center gap-2">
                <span id="top-bar" class="h-1 w-10 bg-black transition-all duration-200"></span>
                <span id="middle-bar" class="h-1 w-7 bg-black transition-all duration-200"></span>
                <span id="bottom-bar" class="h-1 w-4 bg-black transition-all duration-200"></span>
            </div>
        </div>
    </div>

    {{-- filter modal --}}
    <div id="filter-modal" class="absolute w-[90%] -translate-y-[160%] rounded-3xl bg-white p-3 pb-4 shadow-card transition-all duration-300 ease-out">
        <div class="w-full space-y-3">
            <h3 class="text-xl">Kata kunci:</h3>
            <div class="flex flex-wrap gap-2">
                <div class="py-1/2 rounded-3xl border border-gray-500 !bg-gray-100 px-3 text-xl !text-black !transition-all hover:bg-gray-200 focus:outline-none">Semua</div>

                @foreach ($categories as $category)
                    <div class="py-1/2 rounded-3xl border border-gray-500 !bg-gray-100 px-3 text-xl !text-black !transition-all hover:bg-gray-200 focus:outline-none">{{ $category->name }}</div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- List barang --}}
    <div class="flex flex-col gap-3 mb-8">
        @foreach ($items as $item)
            <a href="{{ $item->slug }}" class="group flex gap-2 rounded-3xl bg-white shadow-card">
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

    </div>
</x-layout>
