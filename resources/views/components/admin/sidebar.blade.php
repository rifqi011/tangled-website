@php
    $menuLinks = [
        [
            'Dashboard' => [
                [
                    'name' => 'Dashboard',
                    'href' => '/admin',
                    'icon' => 'home',
                ],
            ],
            'Master Data' => [
                [
                    'name' => 'Data Kelas',
                    'href' => '/admin/kelas',
                    'icon' => 'box',
                ],
                [
                    'name' => 'Data Kategori',
                    'href' => '/admin/kategori',
                    'icon' => 'tag',
                ],
                [
                    'name' => 'Data Admin',
                    'href' => '/admin/admin',
                    'icon' => 'user',
                ],
            ],
            'Settings' => [
                [
                    'name' => 'Settings',
                    'href' => '/admin/settings',
                    'icon' => 'settings',
                ],
            ],
        ],
    ];

    $currentRoute = request()->path();

    function isDashboard($path)
    {
        return $path === '' || $path === '/';
    }

@endphp

<div class="absolute left-0 top-0 flex w-full items-center justify-between bg-white px-[5%] pb-5 pt-3 sm:hidden">
    <div id="sidebar-button" class="group flex h-full cursor-pointer flex-col items-center gap-2">
        <img src="{{ asset('images/icons/hamburger.svg') }}" class="w-8" alt="">
    </div>

    <div class="relative">
        <div id="user-button" class="w-10">
            <img src="{{ asset('images/man.svg') }}" alt="">
        </div>

        <div id="user-dropdown" class="z-50 fixed right-[5%] top-16 flex min-w-48 translate-x-[120%] flex-col gap-2 rounded-lg bg-white px-4 py-2 shadow-lg transition-all duration-200 xl:hidden">
            <h3 class="text-xl font-semibold">Admin</h3>
            <hr class="bg-black">
            <ul class="flex flex-col gap-2 text-lg font-medium text-gray-900">
                <a href="#">Profile</a>
                <a href="#" class="text-red">Log out</a>
            </ul>
        </div>
    </div>
</div>

<aside id="sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white transition-transform sm:sticky sm:translate-x-0 md:h-[calc(100vh-2.5rem)]" aria-label="Sidebar">
    <div class="relative flex h-full flex-col overflow-y-auto px-3 py-4 md:gap-4 md:py-10">
        <div class="mb-5 flex items-center justify-between">
            <a href="{{ url('/admin') }}" class="flex items-center ps-2.5">
                <img src="{{ asset('images/logo-icon-primary.svg') }}" class="me-3 h-7" alt="Tangled Logo" />
                <span class="self-center whitespace-nowrap text-2xl font-semibold sm:text-xl">Tangled</span>
            </a>

            <div id="close-sidebar" class="group flex h-full cursor-pointer flex-col items-center gap-2 sm:hidden">
                <img src="{{ asset('images/icons/x.svg') }}" class="w-8" alt="">
            </div>
        </div>

        <div class="flex flex-col gap-4 overflow-auto overflow-x-hidden xl:h-[22rem] xl:gap-2">
            @foreach ($menuLinks as $menuLink)
                @foreach ($menuLink as $category => $links)
                    <h2 class="ps-2.5 text-lg font-semibold text-gray-900 xl:text-sm">{{ $category }}</h2>
                    <ul class="space-y-2 font-medium">
                        @foreach ($links as $link)
                            @php
                                // Periksa apakah menu aktif
                                $isActive = ($link['href'] === '/' && isDashboard($currentRoute)) || ($link['href'] !== '/' && Request::is(trim($link['href'], '/')));
                            @endphp

                            <li class="ms-2.5">
                                <a href="{{ url($link['href'] ?? '#') }}" class="{{ $isActive ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 px-3 text-lg text-gray-900 hover:bg-gray-200 xl:text-base">
                                    <span>{{ $link['name'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endforeach
        </div>

        <div class="fixed bottom-0 left-0 hidden w-full flex-1 px-3 md:flex md:items-end">
            <div class="flex w-full items-center justify-between rounded-lg bg-gray-200 p-2">
                <a href="#" class="flex items-center gap-3">
                    <img src="{{ asset('images/man.svg') }}" class="w-10" alt="">

                    <div class="">
                        <h3 class="font-semibold">Admin</h3>
                        <p class="text-xs">admin@gmail.com</p>
                    </div>
                </a>

                <a href="">
                    <img src="{{ asset('images/icons/logout.svg') }}" class="w-8" alt="">
                </a>
            </div>
        </div>
    </div>
</aside>
