<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Untree.co" />

    <!-- favicon -->
    <link rel="icon" href="{{asset('house-solid.png')}}">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}" />
    <link rel="stylesheet" href="{{asset('fonts/flaticon/font/flaticon.css')}}" />

    <link rel="stylesheet" href="{{asset('tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('aos.css')}}" />
    <link rel="stylesheet" href="{{asset('style.css')}}" />
    <style>
        @media (max-width: 991px) {
            #logoutBtn {
                color: black;
            }
        }
    </style>
    {{-- 추가 css 있으면 여기 쓰기 --}}
    @if (isset($header))
    <header>
        {{ $header }}
    </header>
    @endif

    <!-- Styles -->
    {{-- @livewireStyles --}}

    <title>
        펫 방
    </title>

</head>
<body>
    {{-- 네비게이션 x-app-layout 시작할때 --}}
    @include('navigation-menu')

    {{-- 컨텐츠 --}}
    <main>
        {{ $slot }}
    </main>

    {{-- 푸터 x-app-layout 마지막에 --}}
    @include('layouts.footer')

    {{-- @livewireScripts --}}
    <script src="{{asset('bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('tiny-slider.js')}}"></script>
    <script src="{{asset('aos.js')}}"></script>
    <script src="{{asset('navbar.js')}}"></script>
    <script src="{{asset('counter.js')}}"></script>
    <script src="{{asset('custom.js')}}"></script>
    <script src="https://kit.fontawesome.com/e615ee2f7e.js" crossorigin="anonymous"></script>
</body>
</html>
