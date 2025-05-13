<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Buat Laporan Penemuan</h1>

        <div class="flex flex-col gap-3">
            <x-user.form.section-header title="Data Barang" />

            <form action="{{ route('found-items.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
                @csrf

                <x-user.form.input name="title" label="Nama Barang" value="{{ old('title') }}" placeholder="Nama barang" required maxlength="255" autofocus />

                <x-user.form.input name="found_location" label="Lokasi Penemuan" value="{{ old('found_location') }}" placeholder="Lokasi penemuan" required maxlength="255" />

                <x-user.form.input name="found_date" label="Tanggal Ditemukan" type="date" value="{{ old('found_date') }}" placeholder="Tanggal Penemuan" required />

                <x-user.form.input name="description" label="Deskripsi" type="textarea" value="{{ old('description') }}" placeholder="Deskripsi barang" required rows="4" />

                <x-user.form.category-select :categories="$categories" :selectedId="old('category_id')" />

                <x-user.form.file-upload name="photo" label="Gambar" labelText="Upload Gambar" />

                <x-user.form.divider />

                <x-user.button type="submit">Buat Laporan</x-user.button>
            </form>
        </div>
    </div>
</x-user.layout>
