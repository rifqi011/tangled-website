@props(['title', 'backUrl' => '/home'])

<div class="flex items-center gap-3">
    <a href="{{ $backUrl }}">
        <img src="{{ asset('/images/icons/chevron-left.svg') }}" class="aspect-square h-8" alt="chevron left">
    </a>
    <h1 class="text-2xl font-bold">{{ $title }}</h1>
</div>
