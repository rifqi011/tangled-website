{{-- resources/views/user/search.blade.php --}}
<x-user.layout>
    <x-user.search-filter :categories="$categories" />

    {{-- List barang --}}
    <div class="mb-8">
        @if (isset($items) && count($items) > 0)
            <div class="flex flex-col gap-5">
                @foreach ($items as $item)
                    <x-user.item-card :item="$item" :type="$item->type ?? null" />
                @endforeach
            </div>
        @else
            <x-user.empty-state image="images/search-not-found.png" message="Coba gunakan kata kunci lainnya atau buat laporan kehilangan">
                <x-slot name="action">
                    <x-user.button href="lost" class="mt-6">Buat laporan</x-user.button>
                </x-slot>
            </x-user.empty-state>
        @endif
    </div>
</x-user.layout>
