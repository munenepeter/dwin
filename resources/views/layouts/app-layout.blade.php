<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f43f5e">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">

    <title>Dwin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-900">
    <main class="min-h-screen space-y-40 pb-10 dark:bg-gray-800">
     {{$slot}}
    </main>
    <x-footer />
    @stack('modals')
    @livewireScripts
</body>

</html>