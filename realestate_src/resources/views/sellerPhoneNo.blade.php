<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('펫 방') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <x-authentication-card>
        <x-slot name="logo">
            <p class="font-bold">판매자 연락처</p>
        </x-slot>
        <x-slot name="slot">
            <div class="mb-4 font-bold text-center">
                <h1>판매자 연락처 : {{ $phone_no }}</h1>
            </div>
        </x-slot>
    </x-authentication-card>
</body>
</html>
