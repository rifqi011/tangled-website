@php
    $currentRoute = request()->path();

    function shouldHideHeader($path)
    {
        return $path === 'search' || preg_match('/^(lost-items|found-items)\/[^\/]+$/', $path);
    }

    $isHeaderHidden = shouldHideHeader($currentRoute);

@endphp

<header id="header" class="{{ $isHeaderHidden ? 'hidden' : 'flex' }} relative left-0 top-0 mb-3 items-center justify-center bg-white px-[5%] pb-5 pt-3">
    <div class="flex w-full items-center justify-between">
        <a href="/">
            <img src="{{ asset('images/logo-text.svg') }}" alt="">
        </a>

        @if (auth()->user())
            <x-user.button href="/dashboard">Dashboard</x-user.button>
        @else
            <x-user.button href="/login">Login</x-user.button>
        @endif
    </div>
</header>
