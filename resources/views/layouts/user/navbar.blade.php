@php
    $menuLinks = [
        [
            'name' => 'Beranda',
            'href' => 'home',
            'icon' => 'home',
        ],
        [
            'name' => 'Cari',
            'href' => 'search.index',
            'icon' => 'search',
        ],
        [
            'name' => 'Kehilangan',
            'href' => 'lost-items.index',
            'icon' => 'file-search',
        ],
        [
            'name' => 'Penemuan',
            'href' => 'found-items.create',
            'icon' => 'check-file',
        ],
    ];

    $currentRoute = Route::currentRouteName();
@endphp

<nav class="fixed bottom-0 left-0 z-[999] w-full rounded-t-3xl bg-white shadow-navbar">
    <ul class="flex justify-between">
        @foreach ($menuLinks as $menuLink)
            @php
                // Check active menu using route name
                $isActive = $currentRoute === $menuLink['href'];
            @endphp

            <li class="relative flex-1 pb-2 pt-4">
                <span class="{{ $isActive ? 'w-12' : 'w-0' }} absolute left-1/2 top-0 h-1 -translate-x-1/2 rounded-b-lg bg-purple transition-all duration-200 ease-in-out"></span>

                <a href="{{ route($menuLink['href']) }}" class="{{ $isActive ? 'text-purple font-bold' : '' }} flex flex-col items-center gap-1 transition-all duration-200 ease-in">
                    <img src="{{ asset('images/icons/' . $menuLink['icon'] . '.svg') }}" class="{{ $isActive ? 'scale-110' : '' }} w-7 transition-all duration-200 ease-in" alt="icon" loading="eager">

                    <span class="text-sm font-medium">{{ $menuLink['name'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
