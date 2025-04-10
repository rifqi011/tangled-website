@props(['href', 'color' => 'black', 'class' => '', 'type'])

@php
    $colors = [
        'black' => 'bg-black',
        'purple' => 'bg-purple',
    ];
@endphp

@if (!empty($href))
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$colors[$color] inline-flex items-center font-medium justify-center rounded-3xl px-4 py-2 align-middle text-md leading-none text-white $class"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$colors[$color] inline-flex items-center font-medium justify-center rounded-3xl px-4 py-2 align-middle text-md leading-none text-white $class"]) }}>
        {{ $slot }}
    </button>
@endif
