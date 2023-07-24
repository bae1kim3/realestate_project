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
    <x-authentication-card>
        <x-slot name="header">
        </x-slot>
        <x-slot name="logo">
        </x-slot>
        <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-9 text-center mt-5">
                        <h1 class="heading" data-aos="fade-up">비밀번호 변경</h1>

                        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                            <ol class="breadcrumb text-center justify-content-center">
                                <li id="use" sytle="color:white"><a href="{{ route('welcome') }}">메인</a></li>
                                <p> / </p>
                                <li id="sell">
                                    비밀번호 변경
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
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <x-validation-errors class="mb-4" />

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="col-6 mb-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required
                    autofocus autocomplete="username" />
            </div>

            <div class="col-6 mb-3">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="form-control" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="col-6 mb-3">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="form-control" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div>
                <x-button class="btn btn-primary py-2 px-3">
                    변경
                </x-button>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    </x-authentication-card>
</x-app-layout>
