<style>
    p{
        color: gray;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            {{ __('매물올리기') }}
        </h2>
    </x-slot>

    <div class="py-12 h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
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
                <div class="alert alert-success" role="alert" style="display: none" id="err_up"></div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <form action="{{ route('struct.insert.post') }}" id="frm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <x-input type="file" name="photo[]" class="form-control-file" multiple />

                                <x-label for="s_name" class="dark:text-white">건물 이름</x-label>
                                <x-input type="text" placeholder="건물 이름" name="s_name" id="s_name" value="{{old('s_name')}}" class="dark:bg-gray-700; dark:text-white"/>
                                <br><br>
                                <x-label for="sell_cat" style="font-size:20px" class="dark:text-white">매매 유형</x-label>
                                <br>
                                <label for="sell_cat_month" class="dark:text-white">월세</label>
                                <input type="radio" name="sell_cat_info" value="월세" id="sell_cat_month" value="{{old('sell_cat_info')}}" class="dark:text-white"/>
                                <label for="sell_cat_jeon" class="dark:text-white">전세</-label>
                                <input type="radio" name="sell_cat_info" value="전세" id="sell_cat_jeon" value="{{old('sell_cat_info')}}" class="dark:text-white"/>
                                <label for="sell_cat_buy" class="dark:text-white">매매</-label>
                                <input type="radio" name="sell_cat_info" value="매매" id="sell_cat_buy" value="{{old('sell_cat_info')}}" class="dark:text-white"/>
                                <br><br>
                                <x-label for="s_size" style="font-size:20px" class="dark:text-white">방 면적</x-label>
                                <x-input type="text" name="s_size" id="s_size" value="{{old('s_size')}}" class="dark:bg-gray-700 dark:text-white"/>m²
                                <br><br>
                                <x-label for="s_addr" style="font-size:20px" class="dark:text-white">주소</x-label>
                                <x-input type="text" id="sample6_address" name="s_addr" placeholder="대구 지역 내 도로명 주소" readonly class="block mt-1 w-full dark:bg-gray-700 dark:text-white"/>
                                <br>
                                <x-button type="button"><x-input type="button"  class="dark:text-white" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"/></x-button>
                                <br>

                                @if(session()->has('addr_err'))
                                    <div>{{session()->get('addr_err')}}</div>
                                @endif
                                @if(session()->has('gu_err'))
                                    <div>{{session()->get('gu_err')}}</div>
                                @endif
                                <x-input type="hidden" name="s_lat" id="s_lat" />
                                <x-input type="hidden" name="s_log" id="s_log" />
                                <br>
                                <x-label for="sub_name" class="dark:text-white">건물과 제일 가까운 역</x-label>
                                <x-input type="text" name="sub_name" id="sub_name" class="dark:text-white"/><p class="dark:text-white">역</p>
                                @if(session()->has('sub_err'))
                                    <div>{{session()->get('sub_err')}}</div>
                                @endif
                                <br>
                                <x-label for="p_deposit" class="dark:text-white">보증금/매매가/전세가</x-label>
                                <x-input type="text" name="p_deposit" id="p_deposit" value="{{old('p_deposit')}}" /><p class="dark:text-white">만원</p><br>
                                <x-label for="p_month" class="dark:text-white">월세</x-label>
                                <x-input type="text" name="p_month" id="p_month" value="{{old('p_month')}}" /><p class="dark:text-white">만원</p>
                                <br>
                                <x-label for="s_fl" class="dark:text-white">층수</x-label>
                                <x-input type="text" name="s_fl" id="s_fl" value="{{old('s_fl')}}" /><p class="dark:text-white">층</p>
                                <hr><br><br>
                                <h3 class="dark:text-white">건물 옵션</h3>
                                <x-label for="s_parking" class="dark:text-white">주차 가능 여부</x-label>
                                <x-input type="radio" name="s_parking" value="1" id="y_parking" />
                                <x-label for="y_parking" class="dark:text-white">가능</x-label>
                                <x-input type="radio" name="s_parking" value="0" id="n_parking" />
                                <x-label for="n_parking" id="n_parking" class="dark:text-white">불가능</x-label>
                                <br>
                                <x-label for="s_ele" class="dark:text-white">엘레베이터 유무</x-label>
                                <x-input type="radio" name="s_ele" value="1" id="y_ele" />
                                <x-label for="y_ele" class="dark:text-white">있음</x-label>
                                <x-input type="radio" name="s_ele" value="0" id="n_ele" />
                                <x-label for="n_ele" class="dark:text-white">없음</x-label>
                                <br>
                                <x-label for="animal_size" class="dark:text-white">대형 동물 허용(25kg 이상)</x-label>
                                <x-input type="radio" name="animal_size" value="1" id="y_animal_size" />
                                <x-label for="y_animal_size" class="dark:text-white">가능</x-label>
                                <x-input type="radio" value="0" name="animal_size" id="n_animal_size" />
                                <x-label for="n_animal_size" class="dark:text-white">불가능</x-label>
                                <br>

                                @if(session('sys_error'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('sys_error') }}
                                    </div>
                                @endif
                                <x-button type="button" id="submit_btn" class="dark:bg-gray-600 dark:text-white">방 올리기</x-button>
                                <x-button type="button" onclick="location.href='{{url('/')}}'" class="dark:bg-gray-600 dark:text-white">취소</x-button>
                            </form>
                            @include('layouts.footer')

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

