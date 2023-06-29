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
        <x-slot name="header">
            {{ __('사용자 라이센스 확인') }}
        </x-slot>
        <x-slot name="logo">
            <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4">
            @if (isset($message))
                <div>{{ $message }}</div>
                <x-button id="btn3">확인</x-button>
            @elseif(isset($error_message))
                <div class="text-red-500">{{ $error_message }}</div>
                <x-button id="btn3">확인</x-button>
            @endif
        </div>
    </x-authentication-card>
</body>

<script>
    const btn3 = document.getElementById("btn3");
    btn3.addEventListener("click", () => {
        window.close();
    });
</script>

</html>
