<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tangled - Barangmu ada, cuma lagi jauh aja</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link rel="shortcut icon" href="{{ asset('images/logo-icon-primary.svg') }}" type="image/x-icon">
    <meta name="description" content="Tangled merupakan sebuah situs karya siswa SMK Negeri 1 Purwokerto untuk mempermudah pencarian barang hilang di lingkungan sekolah.">
</head>

<body>
    <x-user.header></x-user.header>

    <x-user.navbar></x-user.navbar>

    <main class="mx-auto w-[90%]">
        {{ $slot }}
    </main>

    <x-user.footer></x-user.footer>

    {{-- Alert --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    footer: 'Silahkan tunggu konfirmasi dari admin',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endif
</body>

</html>
