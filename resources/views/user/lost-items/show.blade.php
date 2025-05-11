<x-user.item-detail :item="$lostItem" type="lost">
    <x-user.item-info-section :fields="[
        'Nama' => $lostItem->username,
        'Kelas' => $lostItem->class->name,
    ]" />

    <x-user.form.divider />

    <x-user.item-info-section :fields="[
        'Tanggal hilang' => $lostItem->lost_date,
        'Lokasi terakhir' => $lostItem->last_location,
        'Kategori' => $lostItem->category->name,
        'Deskripsi' => $lostItem->description,
    ]" />
</x-user.item-detail>
