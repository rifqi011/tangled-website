<x-layout>
    <div class="relative left-0 top-0 mb-3 items-center justify-center bg-white pb-5 pt-3">
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
    <div id="filter-modal" class="absolute w-[90%] rounded-3xl bg-white p-3 pb-4 shadow-card -translate-y-[160%] transition-all duration-300 ease-out">
        <div class="w-full space-y-3">
            <h3 class="text-xl">Kata kunci:</h3>
            <div class="flex flex-wrap gap-2">
                <div class="rounded-3xl border border-gray-500 !bg-gray-100 px-3 py-1/2 text-xl !text-black !transition-all hover:bg-gray-200 focus:outline-none">Semua</div>

                @foreach ($categories as $category)
                    <div class="rounded-3xl border border-gray-500 !bg-gray-100 px-3 py-1/2 text-xl !text-black !transition-all hover:bg-gray-200 focus:outline-none">{{ $category->name }}</div>
                @endforeach
            </div>
        </div>
    </div>

    <h1>Pencarian</h1>
</x-layout>
