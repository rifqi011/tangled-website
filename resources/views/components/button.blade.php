@props(['href', 'color' => 'black', 'class' => ''])

@php
    $colors = [
        'black' => 'bg-black',
        'purple' => 'bg-purple',
    ];
@endphp

@if (!empty($href))
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$colors[$color] inline-flex items-center justify-center rounded-3xl px-4 py-2 align-middle text-xl leading-none text-white $class"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => "$colors[$color] inline-flex items-center justify-center rounded-3xl px-4 py-2 align-middle text-xl leading-none text-white $class"]) }}>
        {{ $slot }}
    </button>
@endif
