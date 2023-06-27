<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('nav.css') }}">
        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
            *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}
        </style>
        <link rel="stylesheet" href="{{asset('welcome.css')}}">


    </head>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                {{ __('Main') }}
            </h2>
        </x-slot>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">매물올리기</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Select Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">

    <label for="search" class="text-black dark:text-white">매물 검색</label>
    <input type="text" class="rounded-lg px-2 py-1 dark:bg-gray-800 dark:text-white" name="search" id="search" placeholder="역이름, 주소로 검색해 주세요">
    <button onclick="searchProperties()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">검색</button>

    <div id="scroll-container" class="scroll-item">
        @foreach ($photos as $photo)
        <div class="photo-item" style="background-image: url('{{ asset($photo->url) }}');">
            <span class="photo-info">
                <span class="info-text">{{ $photo->s_add }}</span><br>
                <span class="info-text">{{ number_format($photo->p_deposit) }}</span>
                @if ($photo->s_type === '월세')
                <span class="info-text"> / {{ number_format($photo->p_month) }}</span>
                @endif
                <br><span class="info-text">{{ substr($photo->updated_at, 0, 10) }}</span>
            </span>
        </div>
        <input type="hidden" id="lastPhotoItem" data-id="{{ $lastPhotoId }}">
        @endforeach
    </div>





<br>

<div class="flex items-start gap-8">
    <div class="w-1/2">
    <h2 class="text-2xl font-bold mb-4 dark:text-white">동물보호센터</h2>
    <div class="accordion">
        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">대구유기동물보호협회</div>
          <div class="accordion-content">
            <p class="dark:text-white">전화번호 : 053-964-6258</p>
            <p class="dark:text-white">주소 : 대구광역시 동구 금강로 151-13 (금강동)</p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">동행동물병원</div>
          <div class="accordion-content">
            <p class="dark:text-white">전화번호 : 053-636-8720</p>
            <p class="dark:text-white">주소 : 대구광역시 달서구 진천로 117 (대천동) 117,118 호</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">멘토동물병원</div>
          <div class="accordion-content">
            <p class="dark:text-white">전화번호 : 053-291-7579</p>
            <p class="dark:text-white">주소 : 대구광역시 수성구 용학로 294 (범물동) 2층</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white dark:text-white">세인트동물병원</div>
          <div class="accordion-content">
            <p class="dark:text-white">전화번호 : 053-744-8285</p>
            <p class="dark:text-white">주소 : 대구광역시 수성구 청호로 484 (만촌동)</p>
          </div>
        </div>
          </div>
          </div>


    <hr class="my-8 border-gray-300">

    <div class="w-1/2">
      <h2 class="text-2xl font-bold mb-4 dark:text-white">응급동물병원</h2>
      <div class="accordion">
        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">북구</div>
          <div class="accordion-content">
            <p class="dark:text-white">플러스동물의료센터</p>
            <p class="dark:text-white">전화번호 : 053-424-2455</p>
            <p class="dark:text-white">주소 : 대구광역시 북구 중앙대로 526</p>
            <hr>
            <p class="dark:text-white">가온동물병원</p>
            <p class="dark:text-white">전화번호 : 053-958-0075</p>
            <p class="dark:text-white">주소 : 대구광역시 북구 서변동 1746-9</p>
            <hr>
            <p class="dark:text-white">해솔동물병원</p>
            <p class="dark:text-white">전화번호 : 053-959-7775</p>
            <p class="dark:text-white">주소 : 대구광역시 북구 대현동 340-15</p>
          </div>
        </div>
        
        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">서구</div>
          <div class="accordion-content">
            <p class="dark:text-white">삼성동물병원</p>
            <p class="dark:text-white">전화번호 : 053-556-8575</p>
            <p class="dark:text-white">주소 : 대구광역시 서구 내당4동 서대구로 37</p>
            <hr>
            <p class="dark:text-white">진동물병원</p>
            <p class="dark:text-white">전화번호 : 053-554-3575</p>
            <p class="dark:text-white">주소 : 대구광역시 서구 비산2.3동 국채보상로 407</p>
            <hr>
            <p class="dark:text-white">가야동물병원</p>
            <p class="dark:text-white">전화번호 : 053-558-3037</p>
            <p class="dark:text-white">주소 : 대구광역시 서구 평리동 1522-3</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">중구</div>
          <div class="accordion-content">
            <p class="dark:text-white">센트럴동물병원</p>
            <p class="dark:text-white">전화번호 : 053-214-5577</p>
            <p class="dark:text-white">주소 : 대구광역시 중구 대신동 1424</p>
            <hr>
            <p class="dark:text-white">최우식동물병원</p>
            <p class="dark:text-white">전화번호 : 053-767-1588</p>
            <p class="dark:text-white">주소 : 대구광역시 중구 남산4동</p>
            <hr>
            <p class="dark:text-white">중부동물병원</p>
            <p class="dark:text-white">전화번호 : 053-253-8278</p>
            <p class="dark:text-white">주소 : 대구광역시 중구 봉산동 53-2</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">남구</div>
          <div class="accordion-content">
            <p class="dark:text-white">박순석동물메디컬센터</p>
            <p class="dark:text-white">전화번호 : 053-657-0959</p>
            <p class="dark:text-white">주소 : 대구광역시 남구 대명로 72 더원빌딩 2층</p>
            <hr>
            <p class="dark:text-white">현대동물병원</p>
            <p class="dark:text-white">전화번호 : 053-475-5259</p>
            <p class="dark:text-white">주소 : 대구광역시 남구 봉덕로 89</p>
            <hr>
            <p class="dark:text-white">중앙동물병원</p>
            <p class="dark:text-white">전화번호 : 053-625-9198</p>
            <p class="dark:text-white">주소 : 대구광역시 남구 대명6동 1111</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">수성구</div>
          <div class="accordion-content">
            <p class="dark:text-white">24시범어동물의료센터</p>
            <p class="dark:text-white">전화번호 : 053-716-7585</p>
            <p class="dark:text-white">주소 : 대구광역시 수성구 수성동3가 10</p>
            <hr>
            <p class="dark:text-white">대구시지동물병원</p>
            <p class="dark:text-white">전화번호 : 070-8862-5945</p>
            <p class="dark:text-white">주소 : 대구광역시 수성구 달구벌대로 3014</p>
            <hr>
            <p class="dark:text-white">조은동물병원</p>
            <p class="dark:text-white">전화번호 : 053-742-0075</p>
            <p class="dark:text-white">주소 : 대구광역시 수성구 만촌동 달구벌대로 2562</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">동구</div>
          <div class="accordion-content">
            <p class="dark:text-white">봄이온동물병원</p>
            <p class="dark:text-white">전화번호 : 053-962-3264</p>
            <p class="dark:text-white">주소 : 대구광역시 동구 각산동 444-7번지 101호</p>
            <hr>
            <p class="dark:text-white">수호동물병원</p>
            <p class="dark:text-white">전화번호 : 053-982-0275</p>
            <p class="dark:text-white">주소 : 대구광역시 동구 봉무동 1539-3 이시아시티빌딩 205호</p>
            <hr>
            <p class="dark:text-white">변수의과동물병원</p>
            <p class="dark:text-white">전화번호 : 053-983-2069</p>
            <p class="dark:text-white">주소 : 대구광역시 동구 검사동 957-41</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">달서구</div>
          <div class="accordion-content">
            <p class="dark:text-white">대구24시바른동물의료센터</p>
            <p class="dark:text-white">전화번호 : 053-571-0075</p>
            <p class="dark:text-white">주소 : 대구광역시 달서구 와룡로 142 2층</p>
            <hr>
            <p class="dark:text-white">24시라이프동물의료센터</p>
            <p class="dark:text-white">전화번호 : 053-567-2475</p>
            <p class="dark:text-white">주소 : 대구광역시 달서구 감삼동 69-1 1층</p>
            <hr>
            <p class="dark:text-white">대구탑스동물메디컬센터</p>
            <p class="dark:text-white">전화번호 : 053-637-7501</p>
            <p class="dark:text-white">주소 : 대구광역시 달서구 상인2동 월배로 166</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-title font-bold cursor-pointer dark:text-white">달성군</div>
          <div class="accordion-content">
            <p class="dark:text-white">화원연합동물병원</p>
            <p class="dark:text-white">전화번호 : 053-634-7975</p>
            <p class="dark:text-white">주소 : 대구광역시 달성군 화원읍 천내리 156-1</p>
            <hr>
            <p class="dark:text-white">현풍동물병원</p>
            <p class="dark:text-white">전화번호 : 053-614-3570</p>
            <p class="dark:text-white">주소 : 대구광역시 달성군 테크노공원로51 봉리타워 현풍동물병원 613 205호</p>
            <hr>
            <p class="dark:text-white">다사종합동물병원</p>
            <p class="dark:text-white">전화번호 : 053-591-7581</p>
            <p class="dark:text-white">주소 : 대구광역시 달성군 다사읍 죽곡리 23-6</p>
          </div>
        </div>










      </div>
    </div>
  </div>

  <script>
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
      const title = item.querySelector('.accordion-title');
      title.addEventListener('click', () => {
        const isActive = item.classList.contains('active');
        accordionItems.forEach(item => item.classList.remove('active'));
        if (!isActive) {
          item.classList.add('active');
        }
      });
    });
  </script>

    </x-app-layout>
    <script src="{{asset('welcome.js')}}"></script>
    </body>
</html>
