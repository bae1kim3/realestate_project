<style>
    input {
        width: 100%;
    }
</style>

<x-app-layout>
<x-slot name="logo">
        <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
    </x-slot>
    <div class="wrap">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                {{ __('매물올리기') }}
            </h2>
        </x-slot>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="width:37rem">
                @if(Illuminate\Support\Facades\Auth::user()->seller_license)
                        <h2 class="dark:text-white font-bold text-2xl mt-10">
                        {{ __('매물 작성') }}
                        </h2>
                @endif

                <div class="p-10 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-700 dark:border-gray-700 mt-10" style="padding:40px;">
                    <div class="container" style="width:70%">
                        <div class="col-md-4 offset-md-4">
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white" >
                                이미지 업로드
                                <br>
                            </h1>
                            <form action="{{ route('struct.insert.post') }}" id="frm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <x-input type="file" name="photo[]" class="form-control-file mt-2" multiple />
                                @if(session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @foreach($errors->all() as $error)
                                    <div class="mt-3 alert text-red-600 " role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                                <div class="mt-5 text-red-600" role="alert" style="display: none" id="err_up"></div>
                                    <div class="s_name">
                                        <x-label for="s_name" class="mt-5 font-semibold text-xl dark:text-white">건물 이름</x-label>
                                        <x-input type="text" placeholder="건물 이름" name="s_name" id="s_name" value="{{old('s_name')}}" required class="mt-2 dark:bg-gray-600 dark:text-white"/>
                                    </div>
                                    <div class="s_addr">
                                        <x-label for="s_addr" class="mt-5 font-semibold text-xl dark:text-white">주소</x-label>
                                        <x-input type="text" id="sample6_address" name="s_addr" placeholder="대구 지역 내 도로명 주소" readonly required value="{{old('s_addr')}}" class="block mt-1 dark:bg-gray-600 dark:text-white"/>
                                        <x-button type="button" class="mt-3 dark:text-white dark:bg-gray-600" onclick="sample6_execDaumPostcode()" >우편번호 찾기</x-button>
                                    </div>
                                <br>
                                <x-label for="sell_cat" class="mt-5 font-semibold text-xl dark:text-white">매매 유형</x-label>
                                <div class="mt-2">
                                    <label for="sell_cat_month" class="dark:text-white">월세</label>
                                    <input type="radio" name="sell_cat_info" value="월세" id="sell_cat_month" {{old('sell_cat_info') === '월세'? 'checked' : ''}} class="dark:text-white"/>
                                    <label for="sell_cat_jeon" class="dark:text-white">전세</-label>
                                    <input type="radio" name="sell_cat_info" value="전세" id="sell_cat_jeon" {{old('sell_cat_info') === '전세'? 'checked' : ''}} class="dark:text-white"/>
                                    <label for="sell_cat_buy" class="dark:text-white">매매</-label>
                                    <input type="radio" name="sell_cat_info" value="매매" id="sell_cat_buy" {{old('sell_cat_info') === '매매'? 'checked' : ''}} class="dark:text-white"/>
                                </div>
                                <x-label for="s_size"  class="mt-5 font-semibold text-xl dark:text-white">방 면적</x-label>
                                <x-input type="text" name="s_size" id="s_size" required maxlength="11" value="{{old('s_size')}}" class="mt-2 dark:bg-gray-600 dark:text-white" style="width:90%"/><span class="dark:text-white">평</span>
                                <br>
                                <x-input type="hidden" name="s_lat" id="s_lat" />
                                <x-input type="hidden" name="s_log" id="s_log" />
                                <br>
                                <x-label for="sub_name" class="font-semibold text-xl dark:text-white">건물과 제일 가까운 역</x-label>
                                <x-input type="text" name="sub_name" maxlength="11" id="sub_name" required value="{{old('sub_name')}}" class="mt-2 dark:text-white dark:bg-gray-600" style="width:90%"/><span class="dark:text-white">역</span>
                                <x-label for="p_deposit" class="mt-5 font-semibold text-xl dark:text-white">보증금/매매가/전세가</x-label>
                                <x-input type="text" name="p_deposit" id="p_deposit" class="mt-2 dark:bg-gray-600" required value="{{old('p_deposit')}}" maxlength="11" style="width:80%"/><span class="dark:text-white">만원</span><br>
                                <x-label for="p_month" class="mt-5 font-semibold text-xl dark:text-white">월세</x-label>
                                <x-input type="text" name="p_month" id="p_month" class="mt-2 dark:bg-gray-600" value="{{old('p_month')}}" maxlength="11" style="width:80%"/><span class="dark:text-white">만원</span>
                                <br>
                                <x-label for="s_fl" class="mt-5 font-semibold text-xl dark:text-white">층수</x-label>
                                <x-input type="text" name="s_fl" id="s_fl" class="mt-2 dark:bg-gray-600" required value="{{old('s_fl')}}" maxlength="3" style="width:90%"/><span class="dark:text-white">층</span>
                                <hr style="margin-top:40px"><br><br>
                                <x-label for="s_parking" class="font-semibold text-xl dark:text-white">주차 가능 여부</x-label>
                                <div class="mt-2">
                                    <label for="y_parking" class="dark:text-white">가능</label>
                                    <input type="radio" name="s_parking" value="1" id="y_parking" {{old('s_parking') === '1'? 'checked' : ''}}/>
                                    <label for="n_parking" class="dark:text-white">불가능</label>
                                    <input type="radio" name="s_parking" value="0" id="n_parking" {{old('s_parking') === '0'? 'checked' : ''}}/>
                                </div>
                                <br>
                                <x-label for="s_ele" class="font-semibold text-xl dark:text-white">엘리베이터 유무</x-label>
                                <div class="mt-2">
                                    <label for="y_ele" class="dark:text-white">있음</label>
                                    <input type="radio" name="s_ele" value="1" id="y_ele" {{old('s_ele') === '1'? 'checked' : ''}} />
                                    <label for="n_ele" class="dark:text-white">없음</label>
                                    <input type="radio" name="s_ele" value="0" id="n_ele" {{old('s_ele') === '0'? 'checked' : ''}}/>
                                </div>
                                <br>
                                <x-label for="animal_size" class="font-semibold text-xl dark:text-white">대형 동물 허용(25kg 이상)</x-label>
                                <div class="mt-2">
                                <label for="y_animal_size" class="dark:text-white">가능</label>
                                <input type="radio" name="animal_size" value="1" id="y_animal_size" {{old('animal_size') === '1'? 'checked' : ''}}/>
                                <label for="n_animal_size" class="dark:text-white">불가능</label>
                                <input type="radio" value="0" name="animal_size" id="n_animal_size" {{old('animal_size') === '0'? 'checked' : ''}}/>
                                </div>
                                <br>

                                <div class="mt-5">
                                <x-button type="button" id="submit_btn" class="dark:bg-gray-600 dark:text-white">방 올리기</x-button>
                                <x-button type="button" onclick="location.href='{{url('/')}}'" class="dark:bg-gray-600 dark:text-white">취소</x-button>
                                </div>
                            </form>
                            

                            <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing"></script>
                            <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                            <script src="{{asset('addr.js')}}"></script>
                            <script src="{{asset('geo.js')}}"></script>
                        </div>
                    </div>
                </div>
            </div>
                @include('layouts.footer')
        </div>
    </div>

</x-app-layout>


