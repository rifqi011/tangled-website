{{-- resources/views/components/user/search-filter.blade.php --}}

@props(['categories' => []])

<div class="relative left-0 top-0 mb-3 items-center justify-center bg-white bg-clip-content pb-5 pt-3">
    <div class="flex w-full items-center justify-between gap-4">
        <form method="GET" action="{{ route('search.index') }}" class="flex w-full items-center gap-3 rounded-3xl border-2 border-black px-3 py-1">
            <img id="search-icon" src="{{ asset('images/icons/search.svg') }}" alt="icon" class="w-6">

            <input type="search" name="query" id="search" value="{{ request('query') }}" class="w-full py-1 text-base placeholder-black outline-none" autocomplete="off" autofocus placeholder="Nyari sesuatu?">

            <input type="hidden" name="category" id="category_id" value="{{ request('category', 'Semua') }}">
        </form>

        <div id="filter-button" class="group flex h-full cursor-pointer flex-col items-center gap-2">
            <span id="top-bar" class="h-[2px] w-10 bg-black transition-all duration-200"></span>
            <span id="middle-bar" class="h-[2px] w-7 bg-black transition-all duration-200"></span>
            <span id="bottom-bar" class="h-[2px] w-4 bg-black transition-all duration-200"></span>
        </div>
    </div>

    <div id="filter-modal" class="absolute -translate-y-[160%] rounded-3xl bg-white p-3 pb-4 shadow-card transition-all duration-300 ease-out z-50 lg:-translate-y-0 lg:right-0 lg:hidden lg:w-[400px]">
        <div class="w-full space-y-3">
            <h3 class="text-lg">Kata kunci:</h3>
            <div class="flex flex-wrap gap-2">
                <button type="button" class="category-btn py-1/2 {{ request('category', 'Semua') === 'Semua' ? '!bg-purple !text-white' : '!bg-gray-100 !text-black' }} rounded-3xl border border-gray-500 px-3 text-lg !transition-all hover:bg-gray-200 focus:outline-none" data-id="Semua">
                    Semua
                </button>

                @foreach ($categories as $category)
                    <button type="button" class="category-btn py-1/2 {{ request('category') === $category->name ? '!bg-purple !text-white' : '!bg-gray-100 !text-black' }} rounded-3xl border border-gray-500 px-3 text-lg !transition-all hover:bg-gray-200 focus:outline-none" data-id="{{ $category->name }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
