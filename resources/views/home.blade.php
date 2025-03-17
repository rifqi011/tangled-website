@php
    $swiperImages = ['/images/swiper-images/1.png', '/images/swiper-images/2.png', '/images/swiper-images/3.png'];
@endphp

<x-layout>
    <div class="relative">
        {{-- Swiper --}}
        <div class="swiper relative overflow-visible">
            <div class="swiper-wrapper">
                @foreach ($swiperImages as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset($image) }}" alt="Slide Image" class="h-[80%] w-full rounded-3xl object-cover">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        <div class="swiper-custom-pagination left-0 right-0 my-2 flex justify-center">
            <span class="swiper-pagination-bullet custom-bullet"></span>
        </div>
    </div>

    <div class="mt-6 mb-24 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Barang Disimpan Kesiswaan</h1>

        <div class="flex flex-col gap-3">
            @foreach ($foundItems as $item)
                <a href="{{ $item->slug }}" class="shadow-card group flex gap-2 rounded-3xl bg-white">
                    <img src="{{ asset($item->photo) }}" class="min-h-[180px] w-[35%] overflow-hidden rounded-l-3xl bg-gray-200 bg-center object-cover" alt="{{ $item->title }}">

                    <div class="flex h-full w-2/3 flex-col justify-start gap-3 p-2 pl-0">
                        <p class="bg-red self-start rounded-3xl px-5 text-lg capitalize text-white">
                            {{ $item->status }}
                        </p>

                        <h3 class="text-2xl font-semibold">{{ Str::limit($item->title, 25) }}</h3>

                        <p>Ditemukan di {{ $item->found_location }} sejak {{ \Carbon\Carbon::parse($item->found_date)->locale('id')->translatedFormat('d F Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-layout>
