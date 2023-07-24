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
    <style>
        .site-footer {
            height: 100px;
            border-top: 1px solid black;
        }

    </style>
</head>
<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    {{-- 원래 container 들어가있었음 --}}
    <nav class="site-nav justify-content-end p-3" style="height: 12%; z-index:11; background-image: url('images/hero_bg_2.jpg');">
        <div class="">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <a href="{{route('welcome')}}" class="logo m-0 float-start">펫 방</a>
                    <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                        <li class="active"><a href="{{route('welcome')}}">메인</a></li>
                        @if (session('u_id'))
                        <li class="has-children">
                            <a href="#">추가메뉴</a>
                            <ul class="dropdown">
                                @if (session('seller_license'))
                                <li><a href={{ route('dashboard') }}>매물올리기</a></li>
                                @endif
                                <li><a href="{{ route('profile') }}">내 정보</a></li>
                                <li><a href="#">Sell Property</a></li>
                                <li class="has-children">
                                    <a href="#">Dropdown</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Sub Menu One</a></li>
                                        <li><a href="#">Sub Menu Two</a></li>
                                        <li><a href="#">Sub Menu Three</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li><a href="{{ route('sellers_info') }}">공인중개사 목록</a></li>
                        <li><a href="{{ route('info') }}">공지사항</a></li>
                        @if (!session('u_id'))
                        <li><a href="{{ route('login') }}">로그인</a></li>
                        <li><a href="{{ route('register') }}" class="active">회원가입</a></li>
                        @else
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{route('logout')}}" style="color: white" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    로그아웃
                                </a>
                        </li>
                        </form>
                </div>
                @endif
                </ul>

                <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>
            </div>
        </div>
        </div>
    </nav>

    <div class="contents">

        <div class="container1">

            <div class="sidebar" id="sidebar" style="min-width: 290px;"></div>

            <div id="map" style="position: relative;">
                <div class="nav-container">
                    <nav class="nav justify-content-end p-3" style="background-color: #005555;">

                        <button class="shop-btn" id="getshop">
                            <i class="fa-solid fa-paw fa-2x"></i>
                            <p>반려동물 용품점</p>
                        </button>
                        <button class="hosp-btn" id="gethosp">
                            <i class="fa-solid fa-house-chimney-medical fa-2x"></i>
                            <p>동물 병원</p>
                        </button>
                        <button class="walk-btn" id="getpark">
                            <i class="fa-solid fa-seedling fa-2x"></i>
                            <p>공원</p>
                        </button>
                        <select id="option" name="gu" class="selectbox">
                            <option>구 선택</option>
                            <option id="option" value="달서구">달서구</option>
                            <option id="option" value="달성군">달성군</option>
                            <option id="option" value="동구">동구</option>
                            <option id="option" value="서구">서구</option>
                            <option id="option" value="남구">남구</option>
                            <option id="option" value="북구">북구</option>
                            <option id="option" value="수성구">수성구</option>
                            <option id="option" value="중구">중구</option>
                        </select>

                        <div class="dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                건물 형태
                            </div>
                            <div class="dropdown-menu">
                                <label class="custom-label">
                                    <input type="checkbox" class="sshape" id="optcheck6" value="0"> 아파트
                                </label>
                                <label class="custom-label">
                                    <input type="checkbox" class="sshape" id="optcheck7" value="1"> 단독주택
                                </label>
                                <label class="custom-label">
                                    <input type="checkbox" class="sshape" id="optcheck8" value="2"> 오피스텔
                                </label>
                                <label class="custom-label">
                                    <input type="checkbox" class="sshape" id="optcheck9" value="3"> 빌라
                                </label>
                                <label class="custom-label">
                                    <input type="checkbox" class="sshape" id="optcheck10" value="4"> 원룸
                                </label>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                거래 유형
                            </div>
                            <div class="dropdown-menu">
                                <label class="custom-label">
                                    <input type="checkbox" class="opt" id="optcheck1" value="월세"> 🏠월세
                                </label>
                                <label class="custom-label">
                                    <input type="checkbox" class="opt" id="optcheck2" value="전세"> 🏠전세
                                </label>
                                <label class="custom-label">
                                    <input type="checkbox" class="opt" id="optcheck3" value="매매"> 🏠매매
                                </label>
                            </div>
                        </div>
                        <div class="dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                건물 옵션
                            </div>
                            <div class="dropdown-menu">
                                <label class="custom-label">
                                    <input type="checkbox" class="sopt" id="optcheck4" value="s_parking"> 🅿️주차
                                </label>
                                <label class="custom-label">
                                    <input type="checkbox" class="sopt" id="optcheck5" value="s_ele"> 🗄엘베
                                </label>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- 푸터 --}}
    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());

                        </script>
                        . All Rights Reserved. &mdash; Designed with love by
                        Pet Bang</a>
                        <!-- License information: https://untree.co/license/ -->
                    </p>
                    <div>
                        Made by B1K3
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.site-footer -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=9abea084b391e97658a9380c837b9608&libraries=services,clusterer,drawing"></script>
    <script src="{{asset('map2.js')}}"></script>
    <script src="{{asset('bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('tiny-slider.js')}}"></script>
    <script src="{{asset('aos.js')}}"></script>
    <script src="{{asset('navbar.js')}}"></script>
    <script src="{{asset('counter.js')}}"></script>
    <script src="{{asset('custom.js')}}"></script>
    <script src="https://kit.fontawesome.com/e615ee2f7e.js" crossorigin="anonymous"></script>
</body>
</html>
