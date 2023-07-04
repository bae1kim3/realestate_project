<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>펫 방</title>
        <link rel="icon" href="{{asset('house-solid.png')}}">
    <link rel="stylesheet" href="{{asset('map.css')}}">
</head>
<body>
{{-- <x-guest-layout> --}}
<div class="contents">
    <nav class="nav sticky-top justify-content-end p-3" style="background-color: #1f2937;">
        <a class="nav-link active link-light position-absolute top-50 start-0 translate-middle-y ms-4" aria-current="page" href="{{route('welcome')}}"><img src="{{ asset('logo.jpg') }}" alt="" style="width: 50px; height:50px">
        </a>
        @if(!empty($u_info->seller_license))
            <a class="nav-link link-light" href="{{route('dashboard')}}" id="aa">매물 올리기</a>
            @endif
            <button id="getpark">주변 공원</button>
                <select id="option" name="gu" class="selectbox" >
                    <option>구 선택</option>
                    <option id="option" value="달서구">달서구</option>
                    <option id="option" value="달성군">달성군</option>
                    <option id="option" value="동구" >동구</option>
                    <option id="option" value="서구" >서구</option>
                    <option id="option" value="남구" >남구</option>
                    <option id="option" value="북구" >북구</option>
                    <option id="option" value="수성구" >수성구</option>
                    <option id="option" value="중구" >중구</option>
                </select>
            <div class="dropdown">
                <div class="dropdown-toggle" data-toggle="dropdown">
                    거래 유형
                </div>
                <div class="dropdown-menu">
                    <label class="custom-label" >
                    <input type="checkbox" class="opt" id="optcheck1" value="월세" > 🏠월세
                    </label>
                    <label class="custom-label">
                    <input type="checkbox" class="opt" id="optcheck2" value="전세" > 🏠전세
                    </label>
                    <label class="custom-label">
                    <input type="checkbox" class="opt" id="optcheck3" value="매매" > 🏠매매
                    </label>
                </div>
            </div>
            <div class="dropdown">
                <div class="dropdown-toggle" data-toggle="dropdown">
                    건물 옵션
                </div>
                <div class="dropdown-menu">
                    <label class="custom-label">
                    <input type="checkbox" class="sopt" id="optcheck4" value="s_parking" > 🅿️주차
                    </label>
                    <label class="custom-label">
                    <input type="checkbox" class="sopt" id="optcheck5" value="s_ele" > 🗄엘베
                    </label>
                </div>
            </div>

                @if(!empty($u_info) && !empty(session('u_id')))
            <div class="dropdown" >
                <div class="dropdown-toggle1" id="loginuser" data-toggle="dropdown">
                {{$u_info->u_id}}
                </div>
                <div class="dropdown-menu ">
                <a href="{{route('profile.com')}}">
                    <div>마이페이지</div>
                </a>
                <a href="{{route('user.logout')}}">
                    <div>로그아웃</div>
                </a>
                </div>
            </div>
                @else
            <button type="button" class="btn btn-dark" style="background-color: rgb(47, 193, 255);" id="aa" onclick="location.href = '{{route('login')}}'">로그인</button>
                @endif
    </nav>
    <div class="container1">
        <div class="sidebar" id="sidebar"></div>
        <div id="map"></div>
    </div>
</div>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=9abea084b391e97658a9380c837b9608&libraries=services,clusterer,drawing"></script>
    <script src="{{asset('map2.js')}}"></script>
{{-- </x-guest-layout> --}}
</body>
</html>
