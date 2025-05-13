<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Buat Laporan Kehilangan</h1>

        <form action="{{ route('lost-items.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">
            @csrf

            <x-user.form.section-header title="Identitas Pelapor" />

            <div class="flex flex-col gap-2">
                <x-user.form.input name="username" label="Nama Pelapor" value="{{ old('username') }}" placeholder="Nama pelapor" required maxlength="255" autofocus />

                <x-user.form.input name="userphone" label="Nomor Telepon" value="{{ old('userphone', '62') }}" placeholder="Nomor telepon" required maxlength="20" inputmode="numeric" />

                <x-user.form.class-select :classes="$classes" :selectedId="old('class_id')" />
            </div>

            <x-user.form.divider />

            <x-user.form.section-header title="Data Barang" />

            <div class="flex flex-col gap-2">
                <x-user.form.input name="title" label="Nama Barang" value="{{ old('title') }}" placeholder="Nama barang" required maxlength="255" autofocus />

                <x-user.form.input name="last_location" label="Lokasi Terakhir" value="{{ old('last_location') }}" placeholder="Lokasi terakhir" required maxlength="255" />

                <x-user.form.input name="lost_date" label="Tanggal Kehilangan" type="date" value="{{ old('lost_date') }}" placeholder="Tanggal Kehilangan" required />

                <x-user.form.input name="description" label="Deskripsi" type="textarea" value="{{ old('description') }}" placeholder="Deskripsi barang" required rows="4" />

                <x-user.form.category-select :categories="$categories" :selectedId="old('category_id')" />

                <x-user.form.file-upload name="photo" label="Gambar" labelText="Upload Gambar" optional />

                <x-user.form.divider />

                <x-user.button type="submit">Buat Laporan</x-user.button>
            </div>
        </form>
    </div>
</x-user.layout>
