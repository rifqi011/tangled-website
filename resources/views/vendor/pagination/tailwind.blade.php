@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex cursor-default items-center rounded-3xl border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-3xl border border-gray-300 bg-purple px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out hover:bg-purple">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-3xl border border-gray-300 bg-purple px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out hover:bg-purple">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative ml-3 inline-flex cursor-default items-center rounded-3xl border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm leading-5 text-black">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-3xl shadow-sm">
                    {{-- Previous Page --}}
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex cursor-default items-center rounded-l-3xl border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                            ←
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-3xl border border-gray-300 bg-purple px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out hover:bg-purple">
                            ←
                        </a>
                    @endif

                    {{-- Pagination Numbers --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium leading-5 text-black">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-purple px-4 py-2 text-sm font-medium leading-5 text-white">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative -ml-px inline-flex items-center border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium leading-5 text-black transition duration-150 ease-in-out hover:bg-purple hover:text-white">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="relative -ml-px inline-flex items-center rounded-r-3xl border border-gray-300 bg-purple px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out hover:bg-purple">
                            →
                        </a>
                    @else
                        <span class="relative -ml-px inline-flex cursor-default items-center rounded-r-3xl border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                            →
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
