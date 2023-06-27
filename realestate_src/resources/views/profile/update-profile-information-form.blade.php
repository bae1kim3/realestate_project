<link rel="stylesheet" href="{{asset('tab_menu.css')}}">

@if(Illuminate\Support\Facades\Auth::user()->seller_license)
        <h2 class="dark:text-white">
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
    <div id='tab1' data-tab-content class='items active'>
        <p>
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
                <x-label for="id" value="{{ __('ID') }}" />
                <x-input id="id" name="u_id" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->u_id}}" readonly  />

            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" name="email" maxlength="30"  type="email" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->email}}"  />

            </div>

            {{-- phone number --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="phone_no" value="{{ __('Phone number') }}" />
                <x-input id="phone_no" name="phone_no" minlength="10" maxlength="11" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->phone_no}}"  />

            </div>


            {{-- user address --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="u_addr" value="{{ __('Address') }}" />
                <x-input id="sample6_address" type="text" name="u_addr" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" readonly value="{{Auth::user()->u_addr}}"  />
                <x-button type="button" onclick="sample6_execDaumPostcode()" value="주소 검색">주소 검색</x-button>

            </div>

            {{-- hidden 값 x,y --}}
            <div class="col-span-6 sm:col-span-4">
                <x-input id="s_lat" name="s_lat" type="hidden" class="mt-1 block w-full dark:bg-gray-700 dark:text-white"  />
                <x-input id="s_log" name="s_log" type="hidden" class="mt-1 block w-full dark:bg-gray-700 dark:text-white"   />
            </div>

            @if(Illuminate\Support\Facades\Auth::user()->seller_license)
            {{-- seller license --}}
                <div class="col-span-6 sm:col-span-4">
                <x-label for="seller_license" value="{{ __('Seller license') }}" />
                <x-input id="seller_license" name="seller_license" maxlength="10" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" value="{{Auth::user()->seller_license}}" readonly  />

            </div>

            {{-- business name --}}
                <div class="col-span-6 sm:col-span-4">
                <x-label for="b_name" value="{{ __('Business name') }}" />
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


            <x-button wire:loading.attr="disabled" id="submit_btn">
                {{ __('Save') }}
            </x-button>

            </form>
        </p>
    </div>
    <div id='tab2' data-tab-content class='items'>
        <h2>Tab2</h2>
        <p>탭 2에 들어갈 내용</p>
    </div>
</div>





    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="{{asset('addr.js')}}"></script>
    <script src="{{asset('tab_menu.js')}}"></script>
