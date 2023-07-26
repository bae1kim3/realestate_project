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
<x-app-layout>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v17.0&appId=673307384664484&autoLogAppEvents=1" nonce="NZqU5Vh2"></script>
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">로그인</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li id="use" sytle="color:white"><a href="{{ route('welcome') }}">메인</a></li>
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
                            <p style="color:black">
                                대구광역시 중구 동성로<br />
                                그린컴퓨터 아트학원 5층
                            </p>
                        </div>

                        <div class="open-hours mt-4">
                            <i class="icon-clock-o"></i>
                            <h4 class="mb-2">연락가능 시간:</h4>
                            <p style="color:black">
                                Sunday-Friday:<br />
                                11:00 AM - 18:00 PM
                            </p>
                        </div>

                        <div class="email mt-4">
                            <i class="icon-envelope"></i>
                            <h4 class="mb-2">이메일:</h4>
                            <p style="color:black">faer9876@naver.com</p>
                        </div>

                        <div class="phone mt-4">
                            <i class="icon-phone"></i>
                            <h4 class="mb-2">전화번호:</h4>
                            <p style="color:black">+82 010 6625 6834</p>
                        </div>
                    </div>
                </div>

    <x-slot name="logo">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            {{ __('Login') }}
        </h2>
    </x-slot>

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
                <x-validation-errors class="mb-4" />
                <x-label for="u_id" value="{{ __('아이디') }}" class="dark:text-gray-100" />
                <x-input id="u_id" class="form-control" type="text"
                    name="u_id" :value="old('u_id')" required autofocus />
            </div>

            <div class="col-6 mb-3">
                <x-label for="password" value="{{ __('비밀번호') }}" class="dark:text-gray-100" />
                <x-input id="password" class="form-control"
                    type="password" name="password" required autocomplete="current-password" />
            </div>


  <div id="status">
  </div>
            <p class="text-right mt-2">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-100"
                    href="{{ route('find-username') }}">
                    {{ __('아이디를 잊었나요?') }}
                </a>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('비밀번호를 잊었나요?') }}
                </a>
            @endif
            </p>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn btn-primary py-2 px-3">
                    {{ __('Log in') }}
                </button>
            <a href="{{ url('auth/facebook') }}"><img style="width:20%; height:15%" src="{{ asset('facebook.jpg') }}" alt="Facebook"></a>
            <a href="{{ route('login.kakao') }}">카카오 로그인</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
    <style>
    p  {
        color: #888;
    }
    </style>
</x-app-layout>
