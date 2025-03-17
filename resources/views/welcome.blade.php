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
</head>

<body>
    <h1 class="text-3xl font-bold">Tangled</h1>
</body>

</html>
