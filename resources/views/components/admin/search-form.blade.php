<div class="w-full sm:w-1/3">
    <form action="{{ $route }}" method="GET">
        @if (isset($hiddenInputs) && count($hiddenInputs) > 0)
            @foreach ($hiddenInputs as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
        @endif
        <div class="relative">
            <input type="text" name="search" placeholder="{{ $placeholder ?? 'Search...' }}" value="{{ $searchTerm }}" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm shadow-sm focus:border-purple focus:ring focus:ring-purple focus:ring-opacity-50">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <button type="submit" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
