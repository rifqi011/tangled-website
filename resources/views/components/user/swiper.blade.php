@props(['images' => []])

<div class="relative">
    {{-- Swiper --}}
    <div class="swiper relative overflow-visible">
        <div class="swiper-wrapper">
            @foreach ($images as $image)
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