@props(['item', 'type' => null, 'includeContactAdmin' => false, 'backRoute' => null])

<x-user.layout>
    <div class="relative left-0 top-0 flex items-start justify-between bg-white bg-clip-content pb-5 pt-3">
        <h2 class="text-2xl font-bold">{{ $item->title }}</h2>

        <a href="{{ $backRoute ?? (url()->previous() !== url()->current() ? url()->previous() : route($type . '-items.index')) }}">
            <img src="{{ asset('images/icons/x.svg') }}" class="w-10" alt="x icon">
        </a>
    </div>

    <div class="mb-8 flex flex-col gap-1">
        <div class="w-full overflow-hidden rounded-3xl bg-center object-cover">
            <img src="{{ asset($item->photo) }}" class="aspect-square w-full object-cover" alt="{{ $item->title }}" loading="lazy">
        </div>

        <x-user.form.divider />

        {{ $slot }}

        @if ($includeContactAdmin)
            <x-user.form.divider />

            <x-user.button href="https://wa.me/{{ env('ADMIN_PHONE_NUMBER') }}?text=Assalamu'alaikum%20Wr.Wb.%0A%0APermisi%20pak,%20barang%20berjudul%20{{ $item->title }}%20apakah%20masih%20disimpan%20di%20kesiswaan?%0ABarang%20tersebut%20adalah%20milik%20saya.%20Saya%20mohon%20konfirmasi%20dan%20waktu%20pengambilannya.%0ATerima%20kasih.%0A%0AWassalamu'alaikum%20Wr.Wb." target="_blank">
                Hubungi Admin
            </x-user.button>
        @endif
    </div>
</x-user.layout>
