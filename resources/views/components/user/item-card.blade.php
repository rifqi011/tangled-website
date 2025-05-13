@props(['item', 'type' => null])

@php
    $itemType = $type ?? ($item->type ?? '');
    $statusClasses = [
        'disimpan' => 'bg-red',
        'hilang' => 'bg-purple',
        'default' => 'bg-green',
    ];

    $statusClass = $statusClasses[$item->status] ?? $statusClasses['default'];

    // Determine route and location info based on type
    $route = $itemType === 'found' ? 'found-items.show' : 'lost-items.show';
    $locationLabel = $itemType === 'found' ? 'Ditemukan di' : 'Hilang di';
    $locationField = $itemType === 'found' ? $item->found_location ?? $item->location : $item->last_location ?? $item->location;
    $dateField = $itemType === 'found' ? $item->found_date ?? $item->date : $item->lost_date ?? $item->date;
@endphp

<a href="{{ route($route, $item->slug ?? '#') }}" class="group flex min-h-[150px] gap-2 rounded-3xl bg-white shadow-card">
    <div class="relative w-[35%]">
        <img src="{{ asset($item->photo) }}" class="absolute inset-0 h-full w-full rounded-l-3xl bg-gray-200 object-cover z-0" loading="lazy" alt="{{ $item->title }}">
    </div>

    <div class="flex h-full w-2/3 flex-col justify-start p-2 pl-0">
        <p class="{{ $statusClass }} text-md self-start rounded-3xl px-5 capitalize text-white">
            {{ $item->status }}
        </p>

        <h3 class="mt-2 text-2xl font-semibold">{{ Str::limit($item->title, 25) }}</h3>

        <p>{{ $locationLabel }} <strong>{{ $locationField }}</strong> pada {{ \Carbon\Carbon::parse($dateField)->locale('id')->translatedFormat('d F Y') }}</p>
    </div>
</a>
