@php
    $menuLinks = [
        [
            'name' => 'Beranda',
            'href' => '/',
            'icon' => 'home',
        ],
        [
            'name' => 'Cari',
            'href' => '/search',
            'icon' => 'search',
        ],
        [
            'name' => 'Kehilangan',
            'href' => '/lost',
            'icon' => 'file-search',
        ],
        [
            'name' => 'Penemuan',
            'href' => '/found',
            'icon' => 'check-file',
        ],
    ];

    $currentRoute = request()->path();

    function isHome($path)
    {
        return $path === '' || $path === '/';
    }
@endphp

<nav class="shadow-navbar fixed bottom-0 left-0 z-[999] w-full rounded-t-3xl bg-white">
    <ul class="flex justify-between">
        @foreach ($menuLinks as $menuLink)
            @php
                // Periksa apakah menu aktif
                $isActive = ($menuLink['href'] === '/' && isHome($currentRoute)) || ($menuLink['href'] !== '/' && Request::is(trim($menuLink['href'], '/')));
            @endphp

            <li class="relative flex-1 pb-2 pt-4">
                <span class="bg-purple {{ $isActive ? 'w-12' : 'w-0' }} absolute left-1/2 top-0 h-1 -translate-x-1/2 rounded-b-lg transition-all duration-200 ease-in-out"></span>

                <a href="{{ $menuLink['href'] }}" class="{{ $isActive ? 'text-purple font-bold' : '' }} flex flex-col items-center gap-1 transition-all duration-200 ease-in">
                    <img src="{{ asset('images/icons/' . $menuLink['icon'] . '.svg') }}" class="{{ $isActive ? 'scale-110' : '' }} w-7 transition-all duration-200 ease-in" alt="icon">

                    <span class="text-sm font-medium">{{ $menuLink['name'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
