@props(['image' => 'images/error.png', 'message' => 'Tidak ada barang untuk ditampilkan', 'action' => null])

<div class="flex flex-col items-center gap-8">
    <img src="{{ asset($image) }}" class="w-2/3" loading="lazy" alt="empty state illustration">
    <h1 class="mx-auto text-center text-2xl font-bold">{{ $message }}</h1>
    
    @if($action)
        {{ $action }}
    @endif
</div>