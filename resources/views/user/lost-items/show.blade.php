<x-user.layout>
    <div class="relative left-0 top-0 flex items-start justify-between bg-white bg-clip-content pb-5 pt-3">
        <h2 class="text-2xl font-bold">{{ $lostItem->title }}</h2>

        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('lost-items.index') }}">
            <img src="{{ asset('images/icons/x.svg') }}" class="w-10" alt="x icon">
        </a>
    </div>
    <div class="mb-8 flex flex-col gap-1">

        <div class="w-full overflow-hidden rounded-3xl bg-center object-cover">
            <img src="{{ asset($lostItem->photo) }}" class="aspect-square w-full object-cover" alt="" loading="lazy">
        </div>

        <hr class="my-4 bg-black">

        <div class="flex flex-col text-xl">
            <p><span class="font-semibold">Nama: </span>{{ $lostItem->username }}</p>
            <p><span class="font-semibold">Kelas: </span>{{ $lostItem->class->name }}</p>
        </div>

        <hr class="my-4 bg-black">

        <div class="flex flex-col text-xl">
            <p><span class="font-semibold">Tanggal hilang: </span>{{ $lostItem->lost_date }}</p>
            <p><span class="font-semibold">Lokasi terakhir: </span>{{ $lostItem->last_location }}</p>
            <p><span class="font-semibold">Kategori: </span>{{ $lostItem->category->name }}</p>
            <p><span class="font-semibold">Deskripsi: </span>{{ $lostItem->description }}</p>
        </div>
    </div>
</x-user.layout>
