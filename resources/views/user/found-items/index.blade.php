<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <x-user.page-header title="Barang Temuan" />

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

    @if (isset($foundItems) && method_exists($foundItems, 'links'))
        {{ $foundItems->links('vendor.pagination.tailwind') }}
    @endif
</x-user.layout>
