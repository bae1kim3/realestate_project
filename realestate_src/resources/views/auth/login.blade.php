<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="favicon.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}" />

    <link rel="stylesheet" href="{{ asset('tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />


    <title>
        Property &mdash; Free Bootstrap 5 Website Template by Untree.co
    </title>

    <style>
        p {
            color: white;
            margin: 0px 10px
        }

        li {
            color: gray;
        }

        .test {
            display: none;
        }

        .color {
            color: white;
        }

        .color2 {
            color: gray;
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

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <a href="index.html" class="logo m-0 float-start">Property</a>

                    <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                        <li><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="has-children active">
                            <a href="properties.html">property</a>
                            <ul class="dropdown">
                                <li><a href="#">Buy Property</a></li>
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
                        <li><a href="services.html">Services</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>

                    <a href="#"
                        class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                        data-toggle="collapse" data-target="#main-navbar">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">로그인</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li id="use" sytle="color:white"><a href="{{ route('welcome') }}">home</a></li>
                            <p> / </p>
                            <li id="sell">
                                로그인
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info">
                        <div class="address mt-2">
                            <i class="icon-room"></i>
                            <h4 class="mb-2">개발위치:</h4>
                            <p>
                                대구광역시 중구 동성로<br />
                                그린컴퓨터 아트학원 5층
                            </p>
                        </div>

                        <div class="open-hours mt-4">
                            <i class="icon-clock-o"></i>
                            <h4 class="mb-2">연락가능 시간:</h4>
                            <p>
                                Sunday-Friday:<br />
                                11:00 AM - 18:00 PM
                            </p>
                        </div>

                        <div class="email mt-4">
                            <i class="icon-envelope"></i>
                            <h4 class="mb-2">이메일:</h4>
                            <p>faer9876@naver.com</p>
                        </div>

                        <div class="phone mt-4">
                            <i class="icon-phone"></i>
                            <h4 class="mb-2">전화번호:</h4>
                            <p>+82 010 6625 6834</p>
                        </div>
                    </div>
                </div>

    <x-slot name="logo">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            {{ __('Login') }}
        </h2>
    </x-slot>
    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    @if (session('success'))
        <?php session()->flush(); ?>
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                alert('비밀번호 변경 성공 로그인 해주세요');
            });
        </script>
    @endif

    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="col-6 mb-3">
                <x-label for="u_id" value="{{ __('User ID') }}" class="dark:text-gray-100" />
                <x-input id="u_id" class="form-control" type="text"
                    name="u_id" :value="old('u_id')" required autofocus />
            </div>

            <div class="col-6 mb-3">
                <x-label for="password" value="{{ __('Password') }}" class="dark:text-gray-100" />
                <x-input id="password" class="form-control"
                    type="password" name="password" required autocomplete="current-password" />
            </div>

            <p class="text-right mt-2">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-100"
                    href="{{ route('find-username') }}">
                    {{ __('아이디를 잊었나요?') }}
                </a>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-100"
                    href="{{ route('find-userpassinput') }}">
                    {{ __('비밀번호를 잊었나요?') }}
                </a>
            </p>

            <div class="flex items-center justify-end mt-4">
                <x-button class="dark:bg-gray-400">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
</div>
</div>


    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget">
                        <h3>Contact</h3>
                        <address>43 Raymouth Rd. Baltemoer, London 3910</address>
                        <ul class="list-unstyled links">
                            <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                            <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                            <li>
                                <a href="mailto:info@mydomain.com">info@mydomain.com</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="widget">
                        <h3>Sources</h3>
                        <ul class="list-unstyled float-start links">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Vision</a></li>
                            <li><a href="#">Mission</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                        <ul class="list-unstyled float-start links">
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Creative</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="widget">
                        <h3>Links</h3>
                        <ul class="list-unstyled links">
                            <li><a href="#">Our Vision</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>

                        <ul class="list-unstyled social">
                            <li>
                                <a href="#"><span class="icon-instagram"></span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon-twitter"></span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon-facebook"></span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon-linkedin"></span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon-pinterest"></span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon-dribbble"></span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <!--
              **==========
              NOTE:
              Please don't remove this copyright link unless you buy the license here https://untree.co/license/
              **==========
            -->

                    <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        . All Rights Reserved. &mdash; Designed with love by
                        <a href="https://untree.co">Untree.co</a>
                        <!-- License information: https://untree.co/license/ -->
                    </p>
                    <div>
                        Distributed by
                        <a href="https://themewagon.com/" target="_blank">themewagon</a>
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

    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tiny-slider.js') }}"></script>
    <script src="{{ asset('aos.js') }}"></script>
    <script src="{{ asset('navbar.js') }}"></script>
    <script src="{{ asset('counter.js') }}"></script>
    <script src="{{ asset('custom.js') }}"></script>
</body>

</html>
