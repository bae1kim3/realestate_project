<x-app-layout>
<link rel="stylesheet" href="{{asset('tab_menu.css')}}">
<link rel="stylesheet" href="{{asset('mypagelist.css')}}">

<div class="wrap">
@if(Illuminate\Support\Facades\Auth::user()->seller_license)
        <h2 class="dark:text-white font-bold text-2xl mt-10">
        {{ __('Seller Profile Information') }}
        </h2>
@else
        <h2 class="dark:text-white">
        {{ __('Private Profile Information') }}
        </h2>
@endif
        <h4 class="dark:text-white">
        {{ __('Update your account\'s profile information and email address etc.') }}
        </h4>


<div class='main'>
    <div class='tabs'>
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
<div class='content'>
    <div id='tab1' data-tab-content class='items active mx-8'>
        <div>
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

                @foreach($errors->all() as $error)
                <div class="alert alert-success" role="alert" style="color:red">
                    {{ $error }}
                </div>
                @endforeach
                <div class="alert alert-success" role="alert" style="display: none" id="err_up"></div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}"/>
                <x-input id="name" name="name" maxlength="20" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->name}}" readonly  />

            </div>

            {{-- id --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="id" value="{{ __('ID') }}" class="mt-3"/>
                <x-input id="id" name="u_id" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->u_id}}" readonly  />

            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="email" value="{{ __('Email') }}" class="mt-3"/>
                <x-input id="email" name="email" maxlength="30"  type="email" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->email}}"  />

            </div>

            {{-- phone number --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="phone_no" value="{{ __('Phone number') }}" class="mt-3"/>
                <x-input id="phone_no" name="phone_no" minlength="10" maxlength="11" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->phone_no}}"  />

            </div>


            {{-- user address --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="u_addr" value="{{ __('Address') }}" class="mt-3"/>
                <x-input id="sample6_address" type="text" name="u_addr" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" readonly value="{{Auth::user()->u_addr}}"  />
                <x-button type="button" onclick="sample6_execDaumPostcode()" value="주소 검색" class="a_btn mb-4">주소 검색</x-button>

            </div>

            {{-- hidden 값 x,y --}}
            <div class="col-span-6 sm:col-span-4">
                <x-input id="s_lat" name="s_lat" type="hidden" class="mt-1 block w-full dark:bg-gray-700 dark:text-white"  />
                <x-input id="s_log" name="s_log" type="hidden" class="mt-1 block w-full dark:bg-gray-700 dark:text-white"   />
            </div>

            @if(Illuminate\Support\Facades\Auth::user()->seller_license)
            {{-- seller license --}}
                <div class="col-span-6 sm:col-span-4">
                <x-label for="seller_license" value="{{ __('Seller license') }}" class="mt-3"/>
                <x-input id="seller_license" name="seller_license" maxlength="10" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->seller_license}}" readonly  />

            </div>

            {{-- business name --}}
                <div class="col-span-6 sm:col-span-4">
                <x-label for="b_name" value="{{ __('Business name') }}" class="mt-3"/>
                <x-input id="b_name" type="text" name="b_name" maxlength="20" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->b_name}}"  />

            </div>
            @endif

            @if(!(Illuminate\Support\Facades\Auth::user()->seller_license))
                {{-- animal size --}}
                <div class="col-span-6 sm:col-span-4">
                <x-label for="animal_size" value="{{ __('Animal size') }}" />
                {{-- <x-input id="animal_size" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.animal_size" autocomplete="animal_size" /> --}}
                <x-label for="animal_size" value="{{ __('대형 동물') }}" class="dark:text-white"/>
                <input type="radio" name="animal_size" id="animal_size_sm" @if(Illuminate\Support\Facades\Auth::user()->animal_size === "1") checked @endif value="1" name="animal_size" class="dark:bg-gray-700">
                <x-label for="animal_size" value="{{ __('중소형 동물') }}" class="dark:text-white"/>
                <input type="radio" name="animal_size" id="animal_size_lg" @if(Illuminate\Support\Facades\Auth::user()->animal_size === "0") checked @endif value="0" name="animal_size" class="dark:bg-gray-700">
            </div>
            @endif


            <x-button wire:loading.attr="disabled" id="submit_btn" class="s_btn">
                {{ __('Save') }}
            </x-button>

            </form>
        </div>
    </div>
    <div id='tab2' data-tab-content class='items'>
        <div class="list">
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
        </div>
    </div>
</div>

{{-- 이하 비밀번호 변경, 탈퇴 --}}
@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0 dark:text-white">
                    <h1 style="margin-left:40%">If you wannt change password?</h1>
                    <br>
                    <a href="{{ route('profile.chk_phone_no') }}">
                    <x-button style="margin-left:40%">Update Password</x-button>
                    </a>
                </div>

                <x-section-border />
            @endif

@if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                {{--@livewire('profile.delete-user-form')--}}
                    <h1 style="margin-left:40%">Delete account</h1>
                    <p style="margin-left:40%">
                        Permanently delete your account.
                    <p>
                    <br>
                        <a href="{{ route('profile.chk_del_user') }}">
                    <x-danger-button style="margin-left:40%">Delete account
                    </x-danger-button>
                    </a>
                </div>
            @endif


<script src="{{asset('tab_menu.js')}}"></script>
{{-- <script src="{{asset('mybuilding.js')}}"></script> --}}


{{-- <script>
var isLoading = false;
var loadedItems = 0; // 이미 로드된 아이템 수

document.addEventListener('scroll', function() {
    console.log('Scroll event');
    if (!isLoading && isScrolledToBottom()) {
        loadNextPage();
    }
});

function isScrolledToBottom() {
    return (window.innerHeight + window.scrollY) >= document.body.offsetHeight;
}

function loadNextPage() {
    var page = {{ $user_info->currentPage() }};
    if (isLoading) return;
    isLoading = true;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/user/profile?page=' + (page + 1));
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var photoItems = document.querySelector('#tab2 > div');

            // 새로운 아이템을 4개씩 추가
            var fragment = document.createDocumentFragment();
            for (var i = 0; i < 4; i++) {
                if (loadedItems < response.length) {
                    var newElement = document.createElement('div');
                    newElement.innerHTML = response[loadedItems];
                    fragment.appendChild(newElement);
                    loadedItems++;
                }
            }
            photoItems.appendChild(fragment);

            page++; // 페이지 번호 증가
            isLoading = false;
        } else {
            console.log('Request failed. Status: ' + xhr.status);
        }
    };
    xhr.send();
}
</script> --}}
</div>
</x-app-layout>