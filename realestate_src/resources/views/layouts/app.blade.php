<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- favicon -->
    <link rel="icon" href="{{asset('house-solid.png')}}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <title>{{ __('펫 방') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="{ darkMode: false }" x-init="if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    localStorage.setItem('darkMode', JSON.stringify(true));
}
darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak>
    <div x-bind:class="{ 'dark': darkMode === true }" class="min-h-screen bg-gray-100">
        @include('navigation-menu')

        <header class="bg-white shadow dark:bg-gray-800">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8 dark:text-gray-100 dark:text-white">
                <img src="{{ asset('logo.jpg') }}" alt="" style="width: 50px; height:50px">
            </div>
        </header>

        <main class="bg-gray-100 dark:bg-gray-800">
            {{ $slot }}
        </main>

        @stack('modals')

        @livewireScripts
    </div>
</body>

</html>
