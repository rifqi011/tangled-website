<x-user.layout>
    <div class="mb-8 flex flex-col gap-6">
        <h1 class="text-2xl font-bold">Buat Laporan Kehilangan</h1>

        <form action="{{ route('lost-items.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">
            @csrf

            <h2 class="text-xl font-semibold">Identitas Pelapor</h2>

            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <label for="username" class="text-lg font-semibold">Nama Pelapor</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" class="@error('username') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Nama pelapor" required maxlength="255" autofocus>
                    @error('username')
                        <p class="text-red mt-1 text-md">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="userphone" class="text-lg font-semibold">Nomor Telepon</label>
                    <input type="text" name="userphone" id="userphone" value="{{ old('userphone', '62') }}" class="@error('userphone') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Nomor telepon" required maxlength="20" value="62" inputmode="numeric">
                    @error('userphone')
                        <p class="text-red mt-1 text-md">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="class_id" class="text-lg font-semibold">Masukan Kelas</label>
                    <select name="class_id" id="class_id" class="@error('class_id') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 bg-no-repeat px-4 py-2 text-black placeholder:text-black" style="appearance: none; background-image: url('/images/icons/angle-down.svg'); background-position: right 0.7rem center;">
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <p class="text-red mt-1 text-md">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <hr class="my-4 bg-black">

            <h2 class="text-xl font-semibold">Data Barang</h2>

            <div class="flex flex-col gap-2">
                {{-- Nama Barang --}}
                <div class="flex flex-col gap-1">
                    <label for="title" class="text-lg font-semibold">Nama Barang</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="@error('title') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Nama barang" required maxlength="255" autofocus>
                    @error('title')
                        <p class="text-md mt-1 text-red">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi Terakhir --}}
                <div class="flex flex-col gap-1">
                    <label for="last_location" class="text-lg font-semibold">Lokasi Terakhir</label>
                    <input type="text" name="last_location" id="last_location" value="{{ old('last_location') }}" class="@error('last_location') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Lokasi terakhir" required maxlength="255">
                    @error('last_location')
                        <p class="text-red mt-1 text-md">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Kehilangan --}}
                <div class="flex flex-col gap-1">
                    <label for="lost_date" class="text-lg font-semibold">Tanggal Kehilangan</label>
                    <input type="date" name="lost_date" id="lost_date" value="{{ old('lost_date') }}" class="@error('lost_date') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" autocomplete="off" placeholder="Tanggal Kehilangan" required>
                    @error('lost_date')
                        <p class="text-red mt-1 text-md">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="flex flex-col gap-1">
                    <label for="description" class="text-lg font-semibold">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="@error('description') !border-2 !border-red @enderror border-1 w-full rounded-2xl bg-gray-200 px-4 py-2 text-black placeholder:text-black" required placeholder="Deskripsi barang">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red mt-1 text-md">{{ $message }}</p>
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
                    <label for="photo" class="text-lg font-semibold">Gambar (opsional)</label>
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
            </div>
        </form>
    </div>
</x-user.layout>
