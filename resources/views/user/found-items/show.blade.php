<x-user.item-detail :item="$foundItem" type="found" :includeContactAdmin="true">
    <x-user.item-info-section :fields="[
        'Tanggal ditemukan' => $foundItem->found_date,
        'Lokasi ditemukan' => $foundItem->found_location,
        'Kategori' => $foundItem->category->name,
        'Deskripsi' => $foundItem->description,
    ]" />
</x-user.item-detail>
