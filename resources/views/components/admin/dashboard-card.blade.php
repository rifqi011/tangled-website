@props([
    'route' => '',
    'value' => '',
    'title' => '',
])

<a href="{{ $route }}" class="overflow-hidden flex flex-col justify-between gap-6 bg-white p-6 shadow-sm sm:rounded-lg">
    <p class="text-5xl">{{ $value }}</p>
    <div class="flex justify-between items-center">
        <h1>{{ $title }}</h1>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
        </svg>
    </div>
</a>
