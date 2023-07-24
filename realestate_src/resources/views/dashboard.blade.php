<x-app-layout>

    <div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">매물올리기</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">메인</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                매물올리기
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

        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <x-validation-errors class="mb-4" />
            <form action="{{ route('struct.insert.post') }}" id="frm" method="POST" enctype="multipart/form-data">
                @csrf
                <x-input type="file" name="photo[]" class="form-control-file mt-2" multiple />
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {{-- @foreach($errors->all() as $error)
                    <div class="mt-3 alert text-red-600 " role="alert">
                        {{ $error }}
                    </div>
                @endforeach --}}
                <div class="col-6 mb-3" role="alert" style="display: none" id="err_up"></div>
                    <div class="col-6 mb-3">
                        <x-label for="s_name" style="margin-top:20px">건물 이름</x-label>
                        <input type="text" placeholder="건물 이름" name="s_name" id="s_name" value="{{old('s_name')}}" class="form-control" required class="mt-2 dark:bg-gray-600 dark:text-white"/>
                    </div>
                    <div class="col-6 mb-3">
                        <x-label for="s_addr">주소</x-label>
                        <x-input type="text" id="sample6_address" name="s_addr" placeholder="대구 지역 내 도로명 주소" readonly required value="{{old('s_addr')}}" class="form-control"/>
                        <x-button type="button" class="btn btn-primary py-2 px-3" onclick="sample6_execDaumPostcode()" style="margin-top:10px">우편번호 찾기</x-button>
                    </div>
                <x-label for="sell_cat">매매 유형</x-label>
                <div class="col-6 mb-3">
                    <label for="sell_cat_month">월세</label>
                    <input type="radio" name="sell_cat_info" value="월세" id="sell_cat_month" {{old('sell_cat_info') === '월세'? 'checked' : ''}} />
                    <label for="sell_cat_jeon">전세</-label>
                    <input type="radio" name="sell_cat_info" value="전세" id="sell_cat_jeon" {{old('sell_cat_info') === '전세'? 'checked' : ''}} />
                    <label for="sell_cat_buy">매매</-label>
                    <input type="radio" name="sell_cat_info" value="매매" id="sell_cat_buy" {{old('sell_cat_info') === '매매'? 'checked' : ''}} />
                </div>
                {{-- 0723 jy add 건물유형 --}}
                <x-label for="s_options">건물 유형</x-label>
                <div class="col-6 mb-3">
                    <label for="s_info_apt">아파트</label>
                    <input type="radio" name="s_option" value="0" id="s_info_apt" {{old('s_option') === '0'? 'checked' : ''}} />
                    <label for="s_info_house">단독주택</-label>
                    <input type="radio" name="s_option" value="1" id="s_info_house" {{old('s_option') === '1'? 'checked' : ''}} />
                    <label for="s_info_offi">오피스텔</-label>
                    <input type="radio" name="s_option" value="2" id="s_info_offi" {{old('s_option') === '2'? 'checked' : ''}} />
                    <label for="s_info_villa">빌라</-label>
                    <input type="radio" name="s_option" value="3" id="s_info_villa" {{old('s_option') === '3'? 'checked' : ''}} />
                    <label for="s_info_one">원룸</-label>
                    <input type="radio" name="s_option" value="4" id="s_info_one" {{old('s_option') === '4'? 'checked' : ''}} />
                </div>
                <div class="col-6 mb-3">
                <x-label for="s_size"  class="col-6 mb-3">방 면적</x-label>
                <x-input type="text" name="s_size" id="s_size" required maxlength="11" value="{{old('s_size')}}" class="form-control"/>평
                </div>

                <x-input type="hidden" name="s_lat" id="s_lat" />
                <x-input type="hidden" name="s_log" id="s_log" />

            <div class="col-6 mb-3">
                <x-label for="sub_name">건물과 제일 가까운 역</x-label>
                <x-input type="text" name="sub_name" maxlength="11" id="sub_name" required value="{{old('sub_name')}}" class="form-control" />역
            </div>
            <div class="col-6 mb-3">
                <label for="p_deposit">보증금/매매가/전세가</label>
                <input type="text" name="p_deposit" id="p_deposit" class="form-control" required value="{{old('p_deposit')}}" maxlength="11"/>만원
            </div>
                <div class="col-6 mb-3">
                <x-label for="p_month">월세</x-label>
                <x-input type="text" name="p_month" id="p_month" class="form-control" value="{{old('p_month')}}" maxlength="11"/>만원
            </div>
                <div class="col-6 mb-3">
                <x-label for="s_fl">층수</x-label>
                <x-input type="text" name="s_fl" id="s_fl" class="form-control" required value="{{old('s_fl')}}" maxlength="3"/>층
                </div>
                <hr style="margin-top:40px"><br><br>
                <x-label for="s_parking">주차 가능 여부</x-label>
                <div class="col-6 mb-3">
                    <label for="y_parking" class="dark:text-white">가능</label>
                    <input type="radio" name="s_parking" value="1" id="y_parking" {{old('s_parking') === '1'? 'checked' : ''}}/>
                    <label for="n_parking" class="dark:text-white">불가능</label>
                    <input type="radio" name="s_parking" value="0" id="n_parking" {{old('s_parking') === '0'? 'checked' : ''}}/>
                </div>
                <br>
                <x-label for="s_ele" class="font-semibold text-xl dark:text-white">엘리베이터 유무</x-label>
                <div class="col-6 mb-3">
                    <label for="y_ele" class="dark:text-white">있음</label>
                    <input type="radio" name="s_ele" value="1" id="y_ele" {{old('s_ele') === '1'? 'checked' : ''}} />
                    <label for="n_ele" class="dark:text-white">없음</label>
                    <input type="radio" name="s_ele" value="0" id="n_ele" {{old('s_ele') === '0'? 'checked' : ''}}/>
                </div>
                <br>
                <x-label for="animal_size" class="font-semibold text-xl dark:text-white">대형 동물 허용(25kg 이상)</x-label>
                <div class="col-6 mb-3">
                <label for="y_animal_size" class="dark:text-white">가능</label>
                <input type="radio" name="animal_size" value="1" id="y_animal_size" {{old('animal_size') === '1'? 'checked' : ''}}/>
                <label for="n_animal_size" class="dark:text-white">불가능</label>
                <input type="radio" value="0" name="animal_size" id="n_animal_size" {{old('animal_size') === '0'? 'checked' : ''}}/>
                </div>
                <br>

                <div class="col-6 mb-3">
                <x-button type="button" id="submit_btn" class="btn btn-primary py-2 px-3">방 올리기</x-button>
                <x-button type="button" onclick="location.href='{{url('/')}}'" class="btn btn-primary py-2 px-3">취소</x-button>
                </div>
            </form>


            <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing"></script>
            <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
            <script src="{{asset('addr.js')}}"></script>
            <script src="{{asset('geo.js')}}"></script>
        </form>
    </div>
    </div>
    </div>
    </div>

</x-app-layout>
