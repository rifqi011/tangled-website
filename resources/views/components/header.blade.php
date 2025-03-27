@php
    $currentRoute = request()->path();

    function isSearch($path)
    {
        return $path === 'search';
    }

    $isSearchPage = isSearch($currentRoute);
@endphp

<header id="header" class="relative left-0 top-0 items-center justify-center bg-white px-[5%] pb-5 pt-3 mb-3 {{ $isSearchPage ? 'hidden' : 'flex' }}">
    <div class="flex w-full items-center justify-between">
        <a href="/">
            <img src="{{ asset('images/logo-text.svg') }}" alt="">
        </a>

        <x-button href="/login">Login</x-button>
    </div>
</header>
