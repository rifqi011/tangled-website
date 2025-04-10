@php
    $swiperImages = ['/images/swiper-images/1.png', '/images/swiper-images/2.png', '/images/swiper-images/3.png'];
@endphp

<x-user.layout>
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

    <div class="mb-8 mt-6 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Barang Disimpan</h1>

        <div class="flex flex-col gap-5">
            @if ($foundItems->isNotEmpty())
                @foreach ($foundItems as $item)
                    <a href="{{ route('found-items.show', $item->slug ?? '#') }}" class="group flex gap-2 rounded-3xl bg-white shadow-card">
                        <img src="{{ asset($item->photo) }}" class="h-[150px] w-[35%] overflow-hidden rounded-l-3xl bg-gray-200 bg-center object-cover" loading="lazy" alt="{{ $item->title }}">

                        <div class="flex h-full w-2/3 flex-col justify-start p-2 pl-0">
                            <p class="self-start rounded-3xl bg-red px-5 text-md capitalize text-white">
                                {{ $item->status }}
                            </p>

                            <h3 class="text-2xl font-semibold mt-2">{{ Str::limit($item->title, 25) }}</h3>

                            <p>Ditemukan di <strong>{{ $item->found_location }}</strong> pada {{ \Carbon\Carbon::parse($item->found_date)->locale('id')->translatedFormat('d F Y') }}</p>
                        </div>
                    </a>
                @endforeach

                <x-user.button href="found-items" class="mt-6">Lihat lebih banyak</x-user.button>
            @else
                <div class="flex flex-col items-center gap-8">
                    <img src="{{ asset('images/error.png') }}" class="w-2/3" loading="lazy" alt="error picture">
                    <h1 class="text-center text-3xl font-bold">Tidak ada barang untuk ditampilkan</h1>
                </div>
            @endif
        </div>
    </div>
</x-user.layout>
