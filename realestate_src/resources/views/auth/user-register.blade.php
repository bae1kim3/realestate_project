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
                        <li><a href="index.html">Home</a></li>
                        <li class="has-children">
                            <a href="properties.html">Properties</a>
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
                        <li class="active"><a href="contact.html">Contact Us</a></li>
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

    <div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">일반회원 가입</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">메인</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                회원가입
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

                <x-validation-errors class="mb-4" />
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
        <form method="POST" action="{{ route('register') }}">
            <div class="row">
            @csrf
            <div class="col-6 mb-3">
                <x-label for="name" value="{{ __('Name') }}"/>
                <x-input id="name" class="form-control" type="text"
                    name="name" :value="old('name')" autofocus autocomplete="name" />
            </div>

            <div class="col-6 mb-3">
                <x-label for="u_id" value="{{ __('User_ID') }}" class="dark:text-white" />
                <x-input id="u_id" class="form-control" type="text"
                    name="u_id" :value="old('u_id')" autocomplete="u_id" />
            </div>

            <div class="col-6 mb-3" id="check">
                <p style="color:red">id 중복여부 검사를 해주세요</p>
                <x-button type="button"  class="form-control" id="check_button" value="ID 중복 검사" onclick="checkid();"
                    class="dark:bg-gray-600">아이디 중복검사</x-button>
            </div>


            <div class="col-12 mb-3">
                <x-label for="email" value="{{ __('Email') }}" class="dark:text-white" />
                <x-input id="email" class="form-control" type="email"
                    name="email" :value="old('email')" autocomplete="username" />
            </div>

            <div class="col-6 mb-3">
                <x-label for="password" value="{{ __('Password') }}" class="dark:text-white" />
                <x-input id="password" class="form-control" type="password"
                    name="password" autocomplete="new-password" />
            </div>

            <div class="col-6 mb-3">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="dark:text-white" />
                <x-input id="password_confirmation" class="form-control"
                    type="password" name="password_confirmation" autocomplete="new-password" />
            </div>

            <div class="col-6 mb-3">
                <x-label for="password_confirmation" value="{{ __('Selete your PSQ') }}" class="dark:text-white" />
                <div class="dropdown">
                    <button class="dropdown-toggle" onclick="toggleDropdown()" type="button" style="width: 400px">
                        비밀번호 질문
                        <span class="arrow">&#9662;</span>
                    </button>
                    <ul class="dropdown-menu" id="dropdownMenu">
                        <li onclick="selectOption('0', '나의 어릴적 꿈은?')" class="form-control">나의 어릴적 꿈은?</li>
                        <li onclick="selectOption('1', '나의 가장 소중한 보물은?')" class="form-control">나의 가장 소중한 보물은?</li>
                        <li onclick="selectOption('2', '내가 가장 슬펐던 기억은?')" class="form-control">내가 가장 슬펐던 기억은?</li>
                        <li onclick="selectOption('3', '나와 가장 친한 친구는?')" class="form-control">나와 가장 친한 친구는?</li>
                        <li onclick="selectOption('4', '나의 첫번째 직장의 이름은?')" class="form-control">나의 첫번째 직장의 이름은?</li>
                    </ul>
                    <input type="hidden" id="selectedOption" name="pw_question" value="">
                </div>
            </div>

            <div class="col-6 mb-3">
                <x-label for="pw_answer" value="{{ __('Password_Answer') }}" class="dark:text-white" />
                <x-input id="pw_answer" class="form-control" type="text"
                    name="pw_answer" :value="old('pw_answer')" autocomplete="pw_answer" />
            </div>

            <div class="col-6 mb-3">
                <label for="u_addr">address</label>
                <br>
                <x-input type="text" id="sample6_address" name="u_addr"
                class="form-control" placeholder="대구 지역 내 도로명 주소" readonly />
                <br>
                <x-button type="button" onclick="sample6_execDaumPostcode()">우편번호 찾기</x-button>
                <br>
                @if (session()->has('addr_err'))
                    <div>{{ session()->get('addr_err') }}</div>
                @endif
                @if (session()->has('gu_err'))
                    <div>{{ session()->get('gu_err') }}</div>
                @endif
                <input type="hidden" name="s_lat" id="s_lat">
                <input type="hidden" name="s_log" id="s_log">
            </div>

            <div class="col-6 mb-3">
                <x-label for="phone_no" value="{{ __('Phone Number') }}" class="dark:text-white" />
                <x-input id="phone_no" class="form-control" type="tel"
                    name="phone_no" :value="old('phone_no')" autocomplete="phone_no" />
            </div>

            <div>
                <x-label for="animal_size" value="{{ __('대형 동물') }}"/>
                <input type="checkbox" id="animal_size" value="1" name="animal_size">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required class="dark:bg-gray-700" />

                            <div class="ml-2 dark:text-white">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" class="dark:text-red underline" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" class="dark:text-red underline"  href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-white"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 dark:bg-gray-600">
                    {{ __('Register') }}
                </x-button>
            </div>
            </div>
            </div>
            </div>
        </form>
    </div>
    </div>




        <script type="text/javascript"
            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing">
        </script>
        <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
        <script src="{{ asset('addr.js') }}"></script>
        <!-- /.untree_co-section -->




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
                    <div class="col-6 text-center">
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
<script type="text/javascript"
    src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing">
</script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="{{ asset('addr.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function checkid() {
        var userid = document.getElementById('u_id').value;
        if (userid) {
            url = "{{ route('check-id') }}" + "?u_id=" + userid;
            window.open(url, "chkid", "width=700,height=400");
        } else {
            alert('아이디를 입력하세요');
        }
    }

    function toggleDropdown() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('show');
    }

    function selectOption(value, label) {
        document.getElementById('selectedOption').value = value;
        document.querySelector('.dropdown-toggle').innerHTML = label + '<span class="arrow">&#9662;</span>';

        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.remove('show');

        var pwQuestionInput = document.querySelector('input[name="pw_question"]');
        pwQuestionInput.value = option;
    }

    $(document).ready(function() {
        // Input field change event handler
        $('#u_id').on('input', function() {
            var u_id = $(this).val();

            // Perform AJAX request to check if the u_id is already taken
            $.ajax({
                url: '/check-uid', // Replace with the actual URL for checking duplicate u_id
                method: 'POST',
                data: {
                    u_id: u_id
                },
                success: function(response) {
                    if (response.exists) {
                        // u_id is already taken
                        $('#u_id').addClass('is-invalid');
                        $('#u_id-error').html('This User ID is already taken.');
                    } else {
                        // u_id is available
                        $('#u_id').removeClass('is-invalid');
                        $('#u_id-error').html('');
                    }
                }
            });
        });
    });
</script>
