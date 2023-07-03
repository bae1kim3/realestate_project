{{-- ******** save 됐다는 문구!!!!!!!! / 변경사항 안바뀌고 저장했을 때, 문구 뜨게 TODO --}}
<x-app-layout>
<link rel="stylesheet" href="{{asset('tab_menu.css')}}">
<link rel="stylesheet" href="{{asset('mypagelist.css')}}">

<div class="wrap">
    <div class="in_wrap">
        @if(Auth::user()->seller_license)
                <h2 class="dark:text-white font-bold text-2xl pt-6" style="padding-top:50px">
                {{ __('공인중개사 회원 정보') }}
                </h2>
        @else
                <h2 class="dark:text-white font-bold text-2xl pt-6" style="padding-left:20px; padding-top:50px">
                {{ __('개인 회원정보') }}
                </h2>
        @endif


        <div class='main'>
            <div class='tabs text-bold dark:text-white'>
                <div class='tab' data-tab-target='#tab1'>
                @if(Auth::user()->seller_license)
                    <p>공인중개사 마이페이지</p>
                @else
                    <p>개인 마이페이지</p>
                @endif
                </div>
                <div class='tab' data-tab-target='#tab2'>
                @if(Auth::user()->seller_license)
                    <p>내가 올린 매물</p>
                @else
                    <p>찜목록</p>
                @endif
                </div>
            </div>
        </div>


        <div class='content' style="position:relative">
            <div id='tab1' data-tab-content class='items active mx-8 dark:bg-gray-700'>
                <form action="{{ route('update.userinfo.post') }}" id="frm" method="post" >
                @csrf
                {{-- <!-- Profile Photo -->
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" class="hidden"
                                    wire:model="photo"
                                    x-ref="photo"
                                    x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    " />

                        <x-label for="photo" value="{{ __('Photo') }}" class="dark:text-white"/>

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <x-secondary-button class="mt-2 mr-2 dark:bg-gray-700 dark:text-white" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </x-secondary-button>

                        @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button" class="mt-2 dark:bg-gray-700 dark:text-white" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                        @endif

                        <x-input-error for="photo" class="mt-2" />
                    </div>
                @endif --}}


                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{ __('이름') }}" style="font-weight:700"/>
                    <x-input id="name" name="name" maxlength="20" type="text" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->name}}" placeholder="한글 이름으로 작성" />

                </div>


                {{-- phone number --}}
                {{-- <div class="col-span-6 sm:col-span-4">
                    <x-label for="phone_no" value="{{ __('전화번호') }}" class="mt-3"/>
                    <x-input id="phone_no" name="phone_no" minlength="10" maxlength="11" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->phone_no}}"  />

                </div> --}}


                {{-- user address --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="u_addr" value="{{ __('주소') }}" class="mt-3" style="font-weight:700"/>
                    <x-input id="sample6_address" type="text" name="u_addr" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" readonly value="{{Auth::user()->u_addr}}"  />
                    <x-button type="button" onclick="sample6_execDaumPostcode()" value="주소 검색" class="a_btn ">주소 검색</x-button>
                </div>

                {{-- hidden 값 x,y --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-input id="s_lat" name="s_lat" type="hidden" class=" block w-full dark:bg-gray-600 dark:text-white"  />
                    <x-input id="s_log" name="s_log" type="hidden" class=" block w-full dark:bg-gray-600 dark:text-white"   />
                </div>
                @if(Illuminate\Support\Facades\Auth::user()->seller_license)
                {{-- business name --}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="b_name" value="{{ __('상호명') }}" class="mt-3" style="font-weight:700"/>
                        <x-input id="b_name" type="text" name="b_name" maxlength="20" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->b_name}}" placeholder="상호명 작성"/>
                    </div>
                @endif

                @if(!(Illuminate\Support\Facades\Auth::user()->seller_license))
                    {{-- animal size --}}
                    <div class="col-span-6 sm:col-span-4 mt-3">
                        <x-label for="animal_size" value="{{ __('동물크기') }}" style="font-weight:700"/>
                        {{-- <x-input id="animal_size" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.animal_size" autocomplete="animal_size" /> --}}
                        <label for="animal_size_lg" class="dark:text-white">대형</label>
                        <input type="radio" name="animal_size" id="animal_size_lg" @if(Auth::user()->animal_size === "1") checked @endif value="1" name="animal_size" class="dark:bg-gray-700">
                        <label for="animal_size_sm"  class="dark:text-white">중소형</label>
                        <input type="radio" name="animal_size" id="animal_size_sm" @if(Auth::user()->animal_size === "0") checked @endif value="0" name="animal_size" class="dark:bg-gray-700">
                    </div>
                @endif


                <x-button wire:loading.attr="disabled" id="submit_btn" class="s_btn">
                    {{ __('저장') }}
                </x-button>
                </form>

                <div>
                    <hr class="mt-8">
                    @foreach($errors->all() as $error)
                    <div class="alert alert-success" role="alert" style="color:red">
                        {{ $error }}
                    </div>
                    @endforeach
                    <div class="alert alert-success" role="alert" style="display: none" id="err_up"></div>

                    {{-- id input--}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="id" value="{{ __('아이디') }}" class="mt-6" style="font-weight:700"/>
                        <x-input id="id" name="u_id" type="text" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->u_id}}" readonly  />
                    </div>

                    <!-- Email input -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="email" value="{{ __('이메일') }}" class="mt-3" style="font-weight:700"/>
                        <x-input id="email" name="email" maxlength="30"  readonly type="email" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->email}}"  />
                    </div>
                    @if(Illuminate\Support\Facades\Auth::user()->seller_license)
                    {{-- seller license --}}
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="seller_license" value="{{ __('공인중개사 라이센스') }}" class="mt-4" style="font-weight:700"/>
                            <x-input id="seller_license" name="seller_license" maxlength="10" type="text" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->seller_license}}" readonly  />
                        </div>
                    @endif
                </div>
            </div>
            {{-- 내가 올린 매물 --}}
            <div id='tab2' data-tab-content class='items'>
                <div class="list">
                    @if((Illuminate\Support\Facades\Auth::user()->seller_license))
                        @foreach($user as $val)
                            <a href="{{ route('struct.detail', ['s_no' => $val->s_no]) }}">
                            <div class="photo-item" style="background-image: url('{{ asset($val->url) }}');">
                                <span class="photo-info">
                                    <span class="info-text">{{ $val->s_name }}</span><br>
                                    <span class="info-text">{{ $val->s_add }}</span>
                                </span>
                            </div>
                            </a>
                        @endforeach
                    @else
                    <div>찜 목록 추가할 것</div>
                    @endif
                    
                </div>
            </div>
        </div>

            {{-- 이하 비밀번호 변경, 탈퇴 --}}
        <div class="under_con">
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0 dark:text-white" id="pw_ch">
                    <h1>비밀번호를 변경하고 싶으신가요?</h1>
                    <br>
                    <a href="{{ route('profile.chk_phone_no') }}">
                    <x-button class="dark:bg-gray-600">비밀번호 변경</x-button>
                    </a>
                </div>

            @endif
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="mt-10 sm:mt-0 dark:text-white" id="user_del">
                {{--@livewire('profile.delete-user-form')--}}
                    <h1>계정을 삭제하시겠습니까?</h1>
                    <br>
                        <a href="{{ route('profile.chk_del_user') }}">
                    <x-danger-button>회원 탈퇴
                    </x-danger-button>
                    </a>
                </div>
            @endif
        </div>


            <script src="{{asset('tab_menu.js')}}"></script>
            <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
            <script src="{{asset('addr.js')}}"></script>
            {{-- <script src="{{asset('mybuilding.js')}}"></script> --}}

    </div>
</div>
@include('layouts.footer')
</x-app-layout>
