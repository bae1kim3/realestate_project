<style>
    p {
        color: white;
        margin: 0px 10px
    }

    li {
        color: gray;
    }

    .displayNone {
        display: none;
    }

    .color {
        color: white;
    }

    .color2 {
        color: gray;
    }
    @font-face {
    font-family: 'S-CoreDream-6Bold';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-6Bold.woff') format('woff');
    font-weight: normal;
    font-style: normal;
    }
    @font-face {
    font-family: 'S-CoreDream-3Light';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-3Light.woff') format('woff');
    font-weight: normal;
    font-style: normal;
    }

    input {
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        transition: border-color:#dee2e6 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }
    input:hover {
        outline:none
    }
    input:focus {
        outline: 1px solid #adb5bd;
    }
</style>
<x-app-layout>
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">마이페이지</h1>

            <nav
            aria-label="breadcrumb"
            data-aos="fade-up"
            data-aos-delay="200"
            >
            <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.html">메인</a></li>
                <li
                class="breadcrumb-item active text-white-50"
                aria-current="page"
                >
                마이페이지
                </li>
            </ol>
            </nav>
        </div>
        </div>
    </div>
</div>
    <div class="section">
{{-- 찜한 매물 출력 --}}
    @if(Auth::check() && session('seller_license') === null)
            <div class="container">
                <div class="row mb-5 align-items-center">
                    <div class="col-md-6">
                        <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0" style="font-family:'S-CoreDream-6Bold';">
                            찜한 매물
                        </h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev">Prev</span>

                            <span class="next" data-controls="next">Next</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4"></div>
                </div>
                <div class="testimonial-slider-wrap">
                    <div class="testimonial-slider">
                    @if(!empty($liked_info[0]))
                        @foreach($liked_info as $info)
                        <div class="item">
                            <div class="testimonial" >
                                <a href="{{route('struct.detail',['s_no'=>$info->s_no])}}" class="img">
                                    <img src="{{asset($info->url)}}" alt="Image" class="img-fluid" style="width: 350px; height: 300px;" />
                                </a>
                                <div class="info_con" style="padding:30px;">
                                    <a href="{{route('struct.detail',['s_no'=>$info->s_no])}}">
                                        <div class="h5 liked_title" style="color: #005555; font-weight:bold; display:inline-block; border-bottom: 3px solid #005555; padding-bottom:5px">{{ $info->s_name }}</div>
                                    </a>
                                    <div style="margin-bottom:8px">{{ $info->s_add }}</div>
                                    <span class="city d-block mb-3" style="color:black; font-weight:bold; font-size:20px;">{{ number_format($info->p_deposit) }}
                                                @if ($info->s_type === '월세')
                                                / {{ number_format($info->p_month) }}
                                                @endif
                                    </span>
                                    {{-- 건물유형, 대형동물 --}}
                                    <span class="icon-building me-2"></span>
                                        <span class="caption">
                                            @switch($info->s_option)
                                                @case(0)
                                                    아파트
                                                    @break
                                                @case(1)
                                                    단독주택
                                                    @break
                                                @case(2)
                                                    오피스텔
                                                    @break
                                                @case(3)
                                                    빌라
                                                    @break
                                                @case(4)
                                                    원룸
                                                    @break
                                                $@default
                                                    @break
                                            @endswitch
                                        </span>
                                        <span class="fa-solid fa-dog me-2"></span>
                                        <span class="caption"> 대형동물
                                            @switch($info->animal_size)
                                                @case(0)
                                                    <strong>X</strong>
                                                    @break
                                                @case(1)
                                                    <strong>O</strong>
                                                    @break
                                                $@default
                                            @endswitch
                                        </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <span style="font-size:17px">찜한 매물이 없습니다</span>
                        @endif
                    </div>
                </div>
            </div>
            </div>
    @endif

@if(session('seller_license'))
<div class="section sec-testimonials">
            <div class="container">
                <div class="row mb-5 align-items-center">
                    <div class="col-md-6">
                        <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0" style="font-family:'S-CoreDream-6Bold';">
                            내가 올린 매물
                        </h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev">이전</span>

                            <span class="next" data-controls="next">다음</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4"></div>
                </div>
                <div class="testimonial-slider-wrap">
                    <div class="testimonial-slider">
                    @if(!empty($photos[0]))
                        @foreach($photos as $info)
                        <div class="item">
                            <div class="testimonial" >
                                <a href="{{route('struct.detail',['s_no'=>$info->s_no])}}" class="img">
                                    <img src="{{asset($info->url)}}" alt="Image" class="img-fluid" style="width: 350px; height: 300px;" />
                                </a>
                                <div class="info_con" style="padding:30px;">
                                    <a href="{{route('struct.detail',['s_no'=>$info->s_no])}}">
                                        <div class="h5 liked_title" style="color: #005555; font-weight:bold; display:inline-block; border-bottom: 3px solid #005555; padding-bottom:5px">{{ $info->s_name }}</div>
                                    </a>
                                    <div style="margin-bottom:8px">{{ $info->s_add }}</div>
                                    <span class="city d-block mb-3" style="color:black; font-weight:bold; font-size:20px;">{{ number_format($info->p_deposit) }}
                                                @if ($info->s_type === '월세')
                                                / {{ number_format($info->p_month) }}
                                                @endif
                                    </span>
                                    {{-- 건물유형, 대형동물 --}}
                                    <span class="icon-building me-2"></span>
                                        <span class="caption">
                                            @switch($info->s_option)
                                                @case(0)
                                                    아파트
                                                    @break
                                                @case(1)
                                                    단독주택
                                                    @break
                                                @case(2)
                                                    오피스텔
                                                    @break
                                                @case(3)
                                                    빌라
                                                    @break
                                                @case(4)
                                                    원룸
                                                    @break
                                                $@default
                                                    @break
                                            @endswitch
                                        </span>
                                        <span class="fa-solid fa-dog me-2"></span>
                                        <span class="caption"> 대형동물
                                            @switch($info->animal_size)
                                                @case(0)
                                                    <strong>X</strong>
                                                    @break
                                                @case(1)
                                                    <strong>O</strong>
                                                    @break
                                                $@default
                                            @endswitch
                                        </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <span style="font-size:17px">내가 올린 매물이 없습니다</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endif
        <div class="section section-4 bg-light">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-5">
                        <h2 class="font-weight-bold heading text-primary mb-4" style="font-family:'S-CoreDream-6Bold';">
                            내 정보
                        </h2>
                        <p class="text-black-50">
                            개인 정보는 정책 보호법에 따라 향후 3년간 보존됩니다.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-between mb-5">
                    <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                        <div class="img-about dots">
                            <img src="images/hero_bg_3.jpg" alt="Image" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex feature-h">
                            <span class="wrap-icon me-3">
                                <span class="icon-home2"></span>
                            </span>
                            <form action="{{ route('update.userinfo.post') }}" id="frm" method="post" >
                                @csrf
                            <div class="feature-text">
                                <h3 class="heading">주소</h3>
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-input id="sample6_address" type="text" name="u_addr" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" readonly value="{{Auth::user()->u_addr}}"  />
                                        <x-button type="button" onclick="sample6_execDaumPostcode()" value="주소 검색" class="a_btn;btn btn-primary py-2 px-3;" style="border-radius:30px">주소 검색</x-button>
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-input id="s_lat" name="s_lat" type="hidden" class=" block w-full dark:bg-gray-600 dark:text-white"  />
                                        <x-input id="s_log" name="s_log" type="hidden" class=" block w-full dark:bg-gray-600 dark:text-white"   />
                                    </div>
                            </div>
                        </div>

                        <div class="d-flex feature-h">
                            <span class="wrap-icon me-3">
                                <span class="icon-person"></span>
                            </span>
                            <div class="feature-text">
                                <div class="col-span-6 sm:col-span-4">
                                    <h3 class="heading">이름</h3>
                                    <x-input id="name" name="name" maxlength="20" type="text" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->name}}" placeholder="한글 이름으로 작성" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex feature-h">
                            <span class="wrap-icon me-3">
                                @if(Illuminate\Support\Facades\Auth::user()->seller_license)
                                <span class="icon-security"></span>
                                @elseif(!(Illuminate\Support\Facades\Auth::user()->seller_license))
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"  style="transform:translate(30px, 30px)" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M226.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5s.3-86.2 32.6-96.8s70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3S-2.7 179.3 21.8 165.3s59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5v1.6c0 25.8-20.9 46.7-46.7 46.7c-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2C84.9 480 64 459.1 64 433.3v-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3s29.1 51.7 10.2 84.1s-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5s46.9 53.9 32.6 96.8s-52.1 69.1-84.4 58.5z"/></svg>
                                </span>
                                @endif
                            </span>
                            <div class="feature-text">
                                @if(Illuminate\Support\Facades\Auth::user()->seller_license)
                                <h3 class="heading">상호명</h3>
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input id="b_name" type="text" name="b_name" maxlength="20" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->b_name}}" placeholder="상호명 작성"/>
                                </div>
                                @endif
                @if(!(Illuminate\Support\Facades\Auth::user()->seller_license))
                    {{-- animal size --}}
                    <div class="col-span-6 sm:col-span-4 mt-3">
                    <h3 class="heading">내 동물 크기</h3><br>
                        {{-- <x-input id="animal_size" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.animal_size" autocomplete="animal_size" /> --}}
                        <label for="animal_size_lg" class="dark:text-white">대형</label>
                        <input type="radio" name="animal_size" id="animal_size_lg" @if(Auth::user()->animal_size === "1") checked @endif value="1" name="animal_size" class="dark:bg-gray-700">
                        <label for="animal_size_sm"  class="dark:text-white">중소형</label>
                        <input type="radio" name="animal_size" id="animal_size_sm" @if(Auth::user()->animal_size === "0") checked @endif value="0" name="animal_size" class="dark:bg-gray-700">
                    </div>
                @endif
                <br><br><br>
                <x-button wire:loading.attr="disabled" id="submit_btn" class="btn btn-primary py-2 px-3">
                    {{ __('저장') }}
                </x-button>
                    </div>
                    </form>
                        
                        </div>
                    </div>
                </div>
                {{-- <div class="row section-counter mt-5">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="counter-wrap mb-5 mb-lg-0">
                            <span class="number"><span class="countup text-primary">3298</span></span>
                            <span class="caption text-black-50"># of Buy Properties</span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="counter-wrap mb-5 mb-lg-0">
                            <span class="number"><span class="countup text-primary">2181</span></span>
                            <span class="caption text-black-50"># of Sell Properties</span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                        <div class="counter-wrap mb-5 mb-lg-0">
                            <span class="number"><span class="countup text-primary">9316</span></span>
                            <span class="caption text-black-50"># of All Properties</span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                        <div class="counter-wrap mb-5 mb-lg-0">
                            <span class="number"><span class="countup text-primary">7191</span></span>
                            <span class="caption text-black-50"># of Agents</span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="section">
            <div class="row justify-content-center footer-cta" data-aos="fade-up">
                <div class="col-lg-7 mx-auto text-center">
                    <p>
                        <a href="{{ route('profile.chk_del_user') }}">
                            <x-danger-button class="btn btn-primary text-white py-3 px-4">회원 탈퇴
                            </x-danger-button>
                            </a>
                    </p>
                </div>
                <!-- /.col-lg-7 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="{{asset('addr.js')}}"></script>
    <script src="{{asset('geo.js')}}"></script>
</x-app-layout>
