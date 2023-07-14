<link rel="stylesheet" href="{{ asset('detail.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            {{ __('Main') }}
        </h2>
    </x-slot>
    <style>
        .scroll-item {
            position: relative;
            overflow-x: auto;
            white-space: nowrap;
            width: 100%;
            z-index: 0;
        }

        .photo-item {
            display: inline-block;
            margin-right: 10px;
            width: 30%;
            height: 60%;
            border: 1px solid black;
        }

        #detail {
            position: fixed;
            top: 250px;
            right: 40px;
            padding: 15px;
            background-color: white;
            margin: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: top 0.3s ease-in-out;
            z-index: 10;
        }

        img {
            margin-top: 0px auto;
            width: 268px;
            height: 150px;
        }

        h1 {
            font-size: 30px;
            margin-left: 20px;
        }

        #btn1,
        #btn3 {
            float: right;
            position: fixed;
            width: 30px;
            height: 30px;
            margin-top: 200px;
        }

        #btn3 {
            margin-top: 500px;
        }

        html {
            scroll-behavior: smooth;
        }

        #photo {
            padding: 20px;
        }

        #btn4 {
            float: right;
            margin-right: 20px;
        }
        @media screen and (max-width: 700px) {
            #detail {
                position: relative;
                top: auto;
                right: auto;
                margin-top: 10px;
                width: 93%;
                padding: 15px;
                background-color: white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                margin-left: 20px;
            }

        }
    </style>
    <div>
        <div id="scroll-container" class="scroll-item">
            <button type="button" style="z-index:10"><img id="btn1" src="{{asset('arrow-up-solid.png')}}"></button>
            <br>
            <button type="button" style="z-index:10"><img id="btn3" src="{{asset('arrow-down-solid.png')}}"></button>
            <div id="photo">
                @foreach ($photos as $photo)
                    <img class="photo-item" src="{{ asset($photo->url) }}" alt="{{ $photo->url }}">
                @endforeach
            </div>
        </div>
        {{-- <x-button type="button" id="btn4">찜하기</x-button> --}}
        <br>
        <br>
        <h1 class="dark:text-white">건물 정보</h1>
        <div style="margin-left: 30px">
        <div class="hits">조회수 {{$s_info->hits}}</div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                건물 이름 : {{ $s_info->s_name }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                건물 주소 : {{ $s_info->s_add }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                판매 유형 : {{ $s_info->s_type }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                평수 : {{ $s_info->s_size }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                층수 : {{ $s_info->s_fl }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                근처역 : {{ $s_info->s_stai }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                보증금 or 매매가: {{ $s_info->p_deposit }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                월세 or 관리비: {{ $s_info->p_month }}
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                대형동물 가능 여부 :
                @if ($s_info->animal_size == 0)
                    가능
                @else
                    불가능
                @endif
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                주차가능 여부 :
                @if ($data01->s_parking == 0)
                    불가능
                @else
                    가능
                @endif
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:text-white dark:bg-gray-700"
                style="text-align: left">
                엘레베이터 여부 :
                @if ($data01->s_ele== 0)
                    불가능
                @else
                    가능
                @endif
            </div>
        </div>
        <div id="detail">
            <div id="proimg"><img
                    src="https://search.pstatic.net/sunny/?src=https%3A%2F%2Fi.pinimg.com%2Foriginals%2F92%2Faf%2F2f%2F92af2fec0dfc6e661ee8a2cdd114e14b.jpg&type=a340"
                    alt="중개인 얼굴"></div>
            <div class="font-bold">판매자 : {{ $user->name }}</div>
            <div class="font-bold">부동산 : {{ $user->b_name }}</div>
            <x-button type="button" id="btn2" class="dark:text-white">연락처 보기</x-button>
        </div>
        <br>
        <br>
        <br>
        <a id="bottom"></a>
        <h1 class="dark:text-white">위치</h1>
        <div id="map" style="width: 500px; height: 400px; margin-left:30px; margin-bottom:30px;"></div>
        @include('layouts.footer')

        <script type="text/javascript"
            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=9abea084b391e97658a9380c837b9608&libraries=services"></script>
        <script>
            var container = document.getElementById('map');
            var options = {
                center: new kakao.maps.LatLng({{ $s_info->s_log }}, {{ $s_info->s_lat }}),
                level: 5
            };

            var map = new kakao.maps.Map(container, options);

            var position = new kakao.maps.LatLng({{ $s_info->s_log }}, {{ $s_info->s_lat }}); // 마커가 표시될 위치를 설정합니다
            var iwContent = '<div style="padding: 5px;">{{ $s_info->s_name }}</div>'; // 인포윈도우에 표시될 내용입니다

            // 마커를 생성합니다
            var marker = new kakao.maps.Marker({
                map: map,
                position: position
            });

            // 인포윈도우를 생성합니다
            var infowindow = new kakao.maps.InfoWindow({
                content: iwContent
            });
            // 인포윈도우를 마커 위에 표시합니다
            infowindow.open(map, marker);



            const btn2 = document.getElementById("btn2");
            let newWindow = null;

            btn2.addEventListener("click", () => {
                newWindow = window.open("{{ route('sellerPhone', ['s_no' => $photo->s_no]) }}", "find",
                    "width=550,height=200");
            });

            const btn1 = document.getElementById("btn1");
            const btn3 = document.getElementById("btn3");

            btn1.addEventListener("click", () => {
                window.scrollTo(0, 0);
            });

            btn3.addEventListener("click", () => {
                window.scrollTo(0, document.body.scrollHeight);
            });
        </script>

        {{-- <script>
            document.getElementById('btn4').addEventListener('click', function() {
                window.location.href = "{{ route('jjims.store') }}";
            });
        </script> --}}

</x-app-layout>
