{{-- resources/views/components/user/search-filter.blade.php --}}

@props(['categories' => []])

<div class="relative left-0 top-0 mb-3 items-center justify-center bg-white bg-clip-content pb-5 pt-3">
    <div class="flex w-full items-center justify-between gap-4">
        <form method="GET" action="{{ route('search.index') }}" id="search-form" class="flex w-full items-center gap-3 rounded-3xl border-2 border-black px-3 py-1">
            <img id="search-icon" src="{{ asset('images/icons/search.svg') }}" alt="icon" class="w-6">

            <input type="search" name="query" id="search" value="{{ request('query') }}" class="w-full py-1 text-base placeholder-black outline-none" autocomplete="off" autofocus placeholder="Nyari sesuatu?">

            <!-- Hidden inputs for filters -->
            <input type="hidden" name="category" id="category_id" value="{{ request('category', 'Semua') }}">
            <input type="hidden" name="item_type" id="item_type_id" value="{{ request('item_type', 'Semua') }}">
            <input type="hidden" name="start_date" id="start_date_id" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" id="end_date_id" value="{{ request('end_date') }}">
        </form>

        <div id="filter-button" class="group flex h-full cursor-pointer flex-col items-center gap-2">
            <span id="top-bar" class="h-[2px] w-10 bg-black transition-all duration-200"></span>
            <span id="middle-bar" class="h-[2px] w-7 bg-black transition-all duration-200"></span>
            <span id="bottom-bar" class="h-[2px] w-4 bg-black transition-all duration-200"></span>
        </div>
    </div>

    <div id="filter-modal" class="absolute -translate-y-[160%] rounded-3xl bg-white p-3 pb-4 shadow-card transition-all duration-300 ease-out z-50 lg:-translate-y-0 lg:right-0 lg:hidden lg:w-[450px]">
        <div class="w-full space-y-4">
            <!-- Category Filter -->
            <div>
                <h3 class="text-lg mb-2">Kategori:</h3>
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

            <!-- Item Type Filter -->
            <div>
                <h3 class="text-lg mb-2">Tipe Item:</h3>
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="item-type-btn py-1/2 {{ request('item_type', 'Semua') === 'Semua' ? '!bg-purple !text-white' : '!bg-gray-100 !text-black' }} rounded-3xl border border-gray-500 px-3 text-lg !transition-all hover:bg-gray-200 focus:outline-none" data-type="Semua">
                        Semua
                    </button>
                    <button type="button" class="item-type-btn py-1/2 {{ request('item_type') === 'lost' ? '!bg-purple !text-white' : '!bg-gray-100 !text-black' }} rounded-3xl border border-gray-500 px-3 text-lg !transition-all hover:bg-gray-200 focus:outline-none" data-type="lost">
                        Barang Hilang
                    </button>
                    <button type="button" class="item-type-btn py-1/2 {{ request('item_type') === 'found' ? '!bg-purple !text-white' : '!bg-gray-100 !text-black' }} rounded-3xl border border-gray-500 px-3 text-lg !transition-all hover:bg-gray-200 focus:outline-none" data-type="found">
                        Barang Temuan
                    </button>
                </div>
            </div>

            <!-- Date Range Filter -->
            <div>
                <h3 class="text-lg mb-2">Rentang Tanggal:</h3>
                <div class="space-y-2">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="flex-1">
                            <label for="start_date" class="block text-sm text-gray-600 mb-1">Dari Tanggal:</label>
                            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div class="flex-1">
                            <label for="end_date" class="block text-sm text-gray-600 mb-1">Sampai Tanggal:</label>
                            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <button type="button" id="clear-dates" class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Reset Semua Filter
                        </button>
                        <button type="button" id="apply-filters" class="px-4 py-1 text-sm bg-purple text-white rounded-lg hover:bg-purple-700 transition-colors">
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>