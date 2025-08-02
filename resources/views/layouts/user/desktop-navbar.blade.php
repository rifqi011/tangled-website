@php
    $menuLinks = [
        [
            'name' => 'Beranda',
            'href' => 'home',
        ],
        [
            'name' => 'Cari',
            'href' => 'search.index',
        ],
        [
            'name' => 'Kehilangan',
            'href' => 'lost-items.create',
        ],
        [
            'name' => 'Penemuan',
            'href' => 'found-items.create',
        ],
    ];

    $currentRoute = Route::currentRouteName();
@endphp

<nav class="hidden justify-center items-center w-full rounded-t-3xl lg:flex">
    <ul class="flex gap-4">
        @foreach ($menuLinks as $menuLink)
            @php
                // Check active menu using route name
                $isActive = $currentRoute === $menuLink['href'];
            @endphp

            <li class="relative flex-1 pb-2 pt-4">
                <a href="{{ route($menuLink['href']) }}" class="{{ $isActive ? 'text-purple font-bold' : '' }} flex flex-col items-center gap-1 transition-all duration-200 ease-in">
                    <span class="text-sm font-medium">{{ $menuLink['name'] }}</span>
                </a>
                
                <span class="{{ $isActive ? 'w-12' : 'w-0' }} absolute left-1/2 bottom-0 h-1 -translate-x-1/2 rounded-lg bg-purple transition-all duration-200 ease-in-out"></span>
            </li>
        @endforeach
    </ul>
</nav>
