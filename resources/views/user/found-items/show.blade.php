<x-user.layout>
    <div class="relative left-0 top-0 flex items-start justify-between bg-white bg-clip-content pb-5 pt-3">
        <h2 class="text-2xl font-bold">{{ $foundItem->title }}</h2>

        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('found-items.index') }}">
            <img src="{{ asset('images/icons/x.svg') }}" class="w-10" alt="x icon">
        </a>
    </div>
    <div class="mb-8 flex flex-col gap-1">

        <div class="w-full overflow-hidden rounded-3xl bg-center object-cover">
            <img src="{{ asset($foundItem->photo) }}" class="aspect-square w-full object-cover" alt="" loading="lazy">
        </div>

        <hr class="my-4 bg-black">

        <div class="flex flex-col text-xl">
            <p><span class="font-semibold">Tanggal ditemukan: </span>{{ $foundItem->found_date }}</p>
            <p><span class="font-semibold">Lokasi ditemukan: </span>{{ $foundItem->found_location }}</p>
            <p><span class="font-semibold">Kategori: </span>{{ $foundItem->category->name }}</p>
            <p><span class="font-semibold">Deskripsi: </span>{{ $foundItem->description }}</p>
        </div>

        <hr class="my-4 bg-black">

        <x-user.button href="https://wa.me/{{ env('ADMIN_PHONE_NUMBER') }}?text=Assalamu'alaikum%20Wr.Wb.%0A%0APermisi%20pak,%20barang%20berjudul%20{{ $foundItem->title }}%20apakah%20masih%20disimpan%20di%20kesiswaan?%0ABarang%20tersebut%20adalah%20milik%20saya.%20Saya%20mohon%20konfirmasi%20dan%20waktu%20pengambilannya.%0ATerima%20kasih.%0A%0AWassalamu'alaikum%20Wr.Wb." target="_blank">Hubungi Admin</x-user.button>
    </div>
</x-user.layout>
