@php
    $swiperImages = ['/images/swiper-images/1.png', '/images/swiper-images/2.png', '/images/swiper-images/3.png'];
@endphp

<x-user.layout>
    <x-user.swiper :images="$swiperImages" />

    <div class="mt-6 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Barang Temuan</h1>

        @if (isset($foundItems) && count($foundItems) > 0)
            <div class="flex flex-col gap-5">
                @foreach ($foundItems as $item)
                    <x-user.item-card :item="$item" type="found" />
                @endforeach
            </div>
        @else
            <x-user.empty-state message="Tidak ada barang untuk ditampilkan" />
        @endif
    </div>

    @if (isset($foundItems) && $foundItems->isNotEmpty() && isset($hasMoreItems) && $hasMoreItems)
        <x-user.button href="found-items" class="mt-6 w-full">Lihat lebih banyak</x-user.button>
    @endif
</x-user.layout>
