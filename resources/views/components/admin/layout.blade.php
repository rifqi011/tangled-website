<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title . ' - Tangled' ?? 'Admin - Tangled' }}</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/admin.js'])
    @endif
    <link rel="shortcut icon" href="{{ asset('images/logo-icon-primary.svg') }}" type="image/x-icon">
    <meta name="description" content="Tangled merupakan sebuah situs karya siswa SMK Negeri 1 Purwokerto untuk mempermudah pencarian barang hilang di lingkungan sekolah.">
</head>

<body>
    <div class="flex">
        <x-admin.sidebar></x-admin.sidebar>

        <div class="bg-gray-100 flex-1 overflow-auto mt-[72px] px-[5%] xl:px-10 xl:py-10 xl:mt-0">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
