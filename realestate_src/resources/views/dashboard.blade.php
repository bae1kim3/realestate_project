<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            {{ __('매물올리기') }}
        </h2>
    </x-slot>

    <div class="py-12 h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                    이미지 업로드
                    <br>
                </h1>
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @foreach($errors->all() as $error)
                    <div class="alert alert-success" role="alert">
                        {{ $error }}
                    </div>
                    @endforeach

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <form action="{{ route('struct.insert.post') }}" id="frm" method="POST" enctype="multipart/form-data">
                                    {{-- <form action="{{route('struct.insert.post')}}" id="frm" method="post" enctype="multipart/form-data"> --}}
                                    @csrf
                                    {{-- <div class="form-group"> --}}
                                        <input type="file" name="photo[]" class="form-control-file" multiple>
                                    {{-- </div><br> --}}
                                {{-- </form> --}}


                    {{--작성 폼 시작--}}

                    {{-- <form action="{{route('struct.insert.post')}}" id="frm" method="post"> --}}
                        {{-- @csrf --}}
                        <label for="s_name">건물 이름</label>
                        <input type="text" placeholder="건물 이름" name="s_name" id="s_name" value="{{old('s_name')}}" maxlength="30">
                        <br>
                        <label for="sell_cat">매매 유형</label>
                        <input type="radio" name="sell_cat_info" value="월세" id="sell_cat_month" value="{{old('sell_cat_info')}}">
                        <label for="sell_cat_month">월세</label>
                        <input type="radio" name="sell_cat_info" value="전세" id="sell_cat_jeon" value="{{old('sell_cat_info')}}">
                        <label for="sell_cat_jeon">전세</label>
                        <input type="radio" name="sell_cat_info" value="매매" id="sell_cat_buy" value="{{old('sell_cat_info')}}">
                        <label for="sell_cat_buy">매매</label>
                        <br>
                        <label for="s_size">방 면적</label>
                        <input type="text" name="s_size" id="s_size" value="{{old('s_size')}}" maxlength="11">m²
                        <br>
                        <label for="s_addr" >주소</label>
                        {{-- <input type="text" id="sample6_postcode" placeholder="우편번호"> 삭제예정!!--}}
                        <input type="text" id="sample6_address" name="s_addr" placeholder="대구 지역 내 도로명 주소" readonly>
                            <x-button type="button" onclick="sample6_execDaumPostcode()" value="주소 검색">주소 검색</x-button>
                        <br>
                        {{-- @if(session('addr_error'))
                        <div class="alert alert-success" role="alert">
                            {{ session('addr_error') }}
                        </div>
                        @endif 삭제예정!--}}
                        @if(session()->has('addr_err'))
                        <div>{{session()->get('addr_err')}}</div>
                        @endif
                        @if(session()->has('gu_err'))
                        <div>{{session()->get('gu_err')}}</div>
                        @endif
                        <input type="hidden" name="s_lat" id="s_lat">
                        <input type="hidden" name="s_log" id="s_log">
                        {{-- <input type="text" id="sample6_detailAddress" placeholder="상세주소">
                        <input type="text" id="sample6_extraAddress" placeholder="참고항목"> 삭제예정!!--}}
                        <br>
                        <label for="sub_name">건물과 제일 가까운 역</label>
                        <input type="text" name="sub_name" id="sub_name">역
                        {{-- @if(session('error'))
                        <div class="alert alert-success" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif --}}
                        @if(session()->has('sub_err'))
                        <div>{{session()->get('sub_err')}}</div>
                        @endif
                        <br>
                        <label for="p_deposit">매매가/전세가/보증금</label>
                        <input type="text" name="p_deposit" id="p_deposit" value="{{old('p_deposit')}}" maxlength="11">만원
                        @if(session()->has('buy_err'))
                        <div>{{session()->get('buy_err')}}</div>
                        @endif
                        <label for="p_month">월세</label>
                        <input type="text" name="p_month" id="p_month" value="{{old('p_month')}}" maxlength="11">만원
                        @if(session()->has('p_month_err'))
                        <div>{{session()->get('p_month_err')}}</div>
                        @endif
                        <br>
                        <label for="s_fl">층수</label>
                        <input type="text" name="s_fl" id="s_fl" value="{{old('s_fl')}}" maxlength="3">층
                        <hr>
                        <h3>건물 옵션</h3>
                        <label for="s_parking">주차 가능 여부</label>
                        <input type="radio" name="s_parking" value="1" id="y_parking">
                        <label for="y_parking">가능</label>
                        <input type="radio" name="s_parking" value="0" id="n_parking">
                        <label for="n_parking" id="n_parking">불가능</label>
                        <br>
                        <label for="s_ele">엘레베이터 유무</label>
                        <input type="radio" name="s_ele" value="1" id="y_ele">
                        <label for="y_ele">있음</label>
                        <input type="radio" name="s_ele" value="0" id="n_ele">
                        <label for="n_ele">없음</label>
                        <br>
                        <label for="animal_size">대형 동물 허용(25kg 이상)</label>
                        <input type="radio" name="animal_size" value="1" id="y_animal_size">
                        <label for="y_animal_size">가능</label>
                        <input type="radio" value="0" name="animal_size" id="n_animal_size">
                        <label for="n_animal_size">불가능</label>
                        <br>

                        @if(session('insert_err'))
                        <div class="alert alert-success" role="alert">
                            {{ session('insert_err') }}
                        </div>
                        @endif
                        {{-- @if(!session('result'))
                        <x-button id="submit_btn">방 올리기</x-button>                        
                        @else --}}
                        {{-- 이거 아닌거 같음 흑 --}}
                        <x-button type="button" id="submit_btn">방 올리기</x-button>
                        @endif
                        <x-button type="button" onclick="location.href='{{url('/')}}'">취소</x-button>
                    </form>
                    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing"></script>
                    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                    <script src="{{asset('addr.js')}}"></script>
                    <script src="{{asset('geo.js')}}"></script>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</x-app-layout>
