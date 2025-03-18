<x-layout>
    <div class="mb-24 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Buat Laporan Kehilangan</h1>

        <div class="flex flex-col gap-3">
            <h2 class="text-xl font-semibold">Identitas Pelapor</h2>

            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <label for="username" class="text-lg font-semibold">Nama Pelapor</label>
                    <input type="text" name="username" id="username" class="border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Nama pelapor" required maxlength="255" autofocus>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="userphone" class="text-lg font-semibold">Nomor Telepon</label>
                    <input type="text" name="userphone" id="userphone" class="border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Nomor telepon" required maxlength="20" value="62" inputmode="numeric">
                </div>

                <div class="flex flex-col gap-1">
                    <label for="class_id" class="text-lg font-semibold">Masukan Kelas</label>
                    <input type="text" name="class_id" id="class_id" class="border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Kelas pelapor" required maxlength="20">
                </div>
            </div>

            <hr class="my-4 bg-black">

            <h2 class="text-xl font-semibold">Data Barang</h2>

            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <label for="title" class="text-lg font-semibold">Nama Barang</label>
                    <input type="text" name="title" id="title" class="border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Nama barang" required maxlength="255">
                </div>

                <div class="flex flex-col gap-1">
                    <label for="last_location" class="text-lg font-semibold">Lokasi Terakhir</label>
                    <input type="text" name="last_location" id="last_location" class="border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Lokasi terakhir" required maxlength="255">
                </div>

                <div class="flex flex-col gap-1">
                    <label for="lost_date" class="text-lg font-semibold">Tanggal Kehilangan</label>
                    <input type="date" name="last_date" id="last_date" class="border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Tanggal Kehilangan" required>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="description" class="text-lg font-semibold">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" required placeholder="Deskripsi barang"></textarea>
                </div>

                {{-- select categories --}}
                <div class="flex flex-col gap-1">
                    <label class="text-lg font-semibold">Kategori</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($categories as $category)
                            <x-button type="button" class="category-btn border border-gray-500 !bg-gray-100 text-sm !text-black !transition-all hover:bg-gray-200 focus:outline-none" data-id="{{ $category->id }}">
                                {{ $category->name }}
                            </x-button>
                        @endforeach
                    </div>
                    <input type="hidden" name="category_id" id="category_id" required>
                </div>

                {{-- Gambar --}}
                <div class="flex flex-col gap-1">
                    <label for="photo" class="text-lg font-semibold">Gambar</label>
                    <label for="photo" id="upload-label" class="cursor-pointer rounded-3xl bg-black px-4 py-2 text-center text-white">Upload Gambar</label>
                    <input type="file" name="photo" id="photo" class="hidden">
                </div>

                <hr class="my-4 bg-black">

                <x-button type="submit">Buat Laporan</x-button>
            </div>
        </div>
    </div>
</x-layout>
