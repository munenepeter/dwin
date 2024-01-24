<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#799649">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">

    <title>Claim</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <main class="min-h-screen">
     {{$slot}}
    </main>
    <x-footer />
    @stack('modals')
    @livewireScripts
</body>

</html>