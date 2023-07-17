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

    <link rel="stylesheet" href="{{asset('map.css')}}">

        <title>
        펫 방 &mdash; 집구하자
    </title>
</head>
<body>
@include('navigation-menu')
{{-- <x-guest-layout> --}}
<div class="contents">
    {{-- <nav class="nav sticky-top justify-content-end p-3" style="background-color: #1f2937;">
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
    </nav> --}}
    <div class="container1">
        <div class="sidebar" id="sidebar"></div>
        <div id="map"></div>
    </div>
</div>
<style>
.sidebar {
  min-width: 290px;
}
</style>
{{-- <div class="property-item">
                                <a href="{{route('struct.detail',['s_no'=>$photo->s_no])}}" class="img">
                                    <img src="{{ asset('동물펜션.jpg') }}" alt="Image" class="img-fluid" />
                                </a>

                                <div class="property-content">
                                    <div class="price mb-2"><span>{{ $photo->s_name }}</span></div>
                                    <div>
                                        <span class="d-block mb-2 text-black-50">{{ $photo->s_add }}</span>
                                        <span class="city d-block mb-3">{{ number_format($photo->p_deposit) }}
                                            @if ($photo->s_type === '월세')
                                            / {{ number_format($photo->p_month) }}
                                            @endif
                                        </span>

                                        <div class="specs d-flex mb-4">
                                            <span class="d-block d-flex align-items-center me-3">
                                                <span class="icon-building me-2"></span>
                                                <span class="caption">건물형태 넣으셈</span>
                                            </span>
                                            <span class="d-block d-flex align-items-center">
                                                <span class="fa-solid fa-dog me-2"></span>
                                                <span class="caption"> 대형가능여부</span>
                                            </span>
                                        </div>

                                        <a href="{{route('struct.detail',['s_no'=>$photo->s_no])}}" class="btn btn-primary py-2 px-3">매물 보러가기</a>
                                    </div>
                                </div>
                            </div> --}}


    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=9abea084b391e97658a9380c837b9608&libraries=services,clusterer,drawing"></script>
    <script src="{{asset('map2.js')}}"></script>
    {{-- <script src="{{asset('bootstrap.bundle.min.js')}}"></script> --}}
    <script src="{{asset('tiny-slider.js')}}"></script>
    <script src="{{asset('aos.js')}}"></script>
    <script src="{{asset('navbar.js')}}"></script>
    <script src="{{asset('counter.js')}}"></script>
    <script src="{{asset('custom.js')}}"></script>
    <script src="https://kit.fontawesome.com/e615ee2f7e.js" crossorigin="anonymous"></script>
</body>
</html>
