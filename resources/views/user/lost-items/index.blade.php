<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <x-user.page-header title="Barang Hilang" />

        @if (isset($lostItems) && count($lostItems) > 0)
            <div class="flex flex-col gap-5">
                @foreach ($lostItems as $item)
                    <x-user.item-card :item="$item" type="lost" />
                @endforeach
            </div>
        @else
            <x-user.empty-state message="Tidak ada barang untuk ditampilkan" />
        @endif
    </div>

    @if (isset($foundItems) && method_exists($foundItems, 'links'))
        {{ $foundItems->links('vendor.pagination.tailwind') }}
    @endif
</x-user.layout>
