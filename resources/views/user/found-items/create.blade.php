<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Buat Laporan Penemuan</h1>

        <div class="flex flex-col gap-3">
            <h2 class="text-xl font-semibold">Data Barang</h2>

            <form action="{{ route('found-items.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
                @csrf

                {{-- Nama Barang --}}
                <div class="flex flex-col gap-1">
                    <label for="title" class="text-lg font-semibold">Nama Barang</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="@error('title') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Nama barang" required maxlength="255" autofocus>
                    @error('title')
                        <p class="text-md mt-1 text-red">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi Penemuan --}}
                <div class="flex flex-col gap-1">
                    <label for="found_location" class="text-lg font-semibold">Lokasi Penemuan</label>
                    <input type="text" name="found_location" id="found_location" value="{{ old('found_location') }}" class="@error('found_location') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Lokasi penemuan" required maxlength="255">
                    @error('found_location')
                        <p class="text-md mt-1 text-red">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Penemuan --}}
                <div class="flex flex-col gap-1">
                    <label for="found_date" class="text-lg font-semibold">Tanggal Ditemukan</label>
                    <input type="date" name="found_date" id="found_date" value="{{ old('found_date') }}" class="@error('found_date') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Tanggal Penemuan" required>
                    @error('found_date')
                        <p class="text-md mt-1 text-red">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="flex flex-col gap-1">
                    <label for="description" class="text-lg font-semibold">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="@error('description') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" required placeholder="Deskripsi barang">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-md mt-1 text-red">{{ $message }}</p>
                    @enderror

                </div>

                {{-- select categories --}}
                <div class="flex flex-col gap-1">
                    <label class="text-lg font-semibold">Kategori</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($categories as $category)
                            <x-user.button type="button" class="select-category-btn {{ old('category_id') == $category->id ? '!bg-purple !text-white' : '' }} border border-gray-500 !bg-gray-100 text-sm !text-black !transition-all hover:bg-gray-200 focus:outline-none" data-id="{{ $category->id }}">
                                {{ $category->name }}
                            </x-user.button>
                        @endforeach
                    </div>
                    <input type="hidden" name="category_id" id="category_id" value="{{ old('category_id') }}" required>
                    @error('category_id')
                        <p class="text-md mt-1 text-red">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Gambar --}}
                <div class="flex flex-col gap-1">
                    <label for="photo" class="text-lg font-semibold">Gambar</label>
                    <div class="flex flex-col">
                        <label for="photo" id="upload-label" class="@error('photo') !border-red border-2 @enderror cursor-pointer rounded-3xl bg-black px-4 py-2 text-center text-white">Upload Gambar</label>
                        <input type="file" name="photo" id="photo" class="hidden">
                        <p id="file-chosen" class="mt-2 text-sm text-gray-600">Tidak ada file dipilih</p>
                    </div>
                    @error('photo')
                        <p class="text-md mt-1 text-red">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="my-4 bg-black">

                <x-user.button type="submit">Buat Laporan</x-user.button>
            </form>
        </div>
    </div>
</x-user.layout>
