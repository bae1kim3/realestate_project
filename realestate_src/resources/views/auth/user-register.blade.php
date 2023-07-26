<x-app-layout>
    {{-- 타이틀 --}}
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

    {{-- 회사 정보 --}}
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

                {{-- 회원가입 작성폼 --}}
                <x-validation-errors class="mb-4" />
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="col-6 mb-3">
                                <x-label for="name" value="{{ __('이름') }}" />
                                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                                <span id="name-error" class="error-message" style="color: rgb(250, 73, 73);"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <x-label for="u_id" value="{{ __('아이디') }}" class="dark:text-white" />
                                <x-input id="u_id" class="form-control" type="text" name="u_id" :value="old('u_id')" autocomplete="u_id" />
                                <span id="u_id-error" class="error-message" style="color: rgb(250, 73, 73);"></span>
                            </div>

                            <div class="mt-4" id="check">
                                <x-button type="button" class="form-control" id="check_button" value="아이디 중복 검사" onclick="checkid();" class="dark:bg-gray-600" style="background-color:#00204a;">아이디 중복검사</x-button>
                            </div>


                            <div class="col-6 mb-3">
                                <x-label for="email" value="{{ __('이메일') }}" class="dark:text-white" />
                                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" autocomplete="username" />
                                <span id="email-error" class="error-message" style="color: rgb(250, 73, 73);"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <x-label for="password" value="{{ __('비밀번호') }}" class="dark:text-white" />
                                <x-input id="password" class="form-control" type="password" name="password" autocomplete="new-password" />
                                <span id="password-error" class="error-message" style="color: rgb(250, 73, 73);"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <x-label for="password_confirmation" value="{{ __('비밀번호 확인') }}" class="dark:text-white" />
                                <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="new-password" />
                                <span id="password_confirmation-error" class="error-message" style="color: rgb(250, 73, 73);"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <x-label for="pw_question" value="{{ __('비밀번호 찾기 전용 질문') }}" class="dark:text-white" />
                                <div class="dropdown">
                                    <button class="dropdown-toggle" onclick="toggleDropdown()" type="button" style="width: 60%">
                                        비밀번호 찾기 전용 질문
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
                                <x-label for="pw_answer" value="{{ __('질문 답변') }}" class="dark:text-white" />
                                <x-input id="pw_answer" class="form-control" type="text" name="pw_answer" :value="old('pw_answer')" autocomplete="pw_answer" />
                                <span id="pw_answer-error" class="error-message" style="color: rgb(250, 73, 73);"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="u_addr">주소</label>
                                <br>
                                <x-input type="text" id="sample6_address" name="u_addr" class="form-control" placeholder="대구 지역 내 도로명 주소" readonly />
                                <br>
                                <x-button type="button" onclick="sample6_execDaumPostcode()" style="background-color:#00204a;">우편번호 찾기</x-button>
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
                                <x-label for="phone_no" value="{{ __('전화번호') }}" class="dark:text-white" />
                                <x-input id="phone_no" class="form-control" type="tel" name="phone_no" :value="old('phone_no')" autocomplete="phone_no" />
                                <span id="phone_no-error" class="error-message" style="color: rgb(250, 73, 73);"></span>
                            </div>

                            <div>
                                <x-label for="animal_size" value="{{ __('대형 동물') }}" />
                                <input type="checkbox" id="animal_size" value="1" name="animal_size">
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox name="terms" id="terms" required class="dark:bg-gray-700" />
                                        <div class="ml-2 dark:text-white">
                                            {!! __(':terms_of_service과 :privacy_policy에 동의합니다.', [
                                            'terms_of_service' =>
                                            '<a target="_blank" class="dark:text-red underline" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                __('이용 약관') .
                                                '</a>',
                                            'privacy_policy' =>
                                            '<a target="_blank" class="dark:text-red underline" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                __('개인정보 보호 정책') .
                                                '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                            @endif
                            <div class="fb-login-button" data-width="" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"><a href="{{ url('auth/facebook') }}">페이스북으로 시작하기</a></div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4 dark:bg-gray-600" style="background-color:#00204a;">
                                    {{ __('회원가입') }}
                                </x-button>
                                <br>
                                <br>
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-white" href="{{ route('login') }}">
                                    {{ __('이미 회원이신가요?') }}
                                </a>
                            </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="{{ asset('addr.js') }}"></script>
    <script src="{{ asset('register.js')}}"></script>
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
    </script>
</x-app-layout>
