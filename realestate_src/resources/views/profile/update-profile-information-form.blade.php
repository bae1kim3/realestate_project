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
                        <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
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
    @endif

@if(session('seller_license'))
<div class="section sec-testimonials">
            <div class="container">
                <div class="row mb-5 align-items-center">
                    <div class="col-md-6">
                        <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                            내가 올린 매물
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
                        <h2 class="font-weight-bold heading text-primary mb-4">
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
                                <h3 class="heading">내 주소</h3>
                                <p class="text-black-50">
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="u_addr" value="{{ __('주소') }}" class="mt-3" style="font-weight:700"/>
                                        <x-input id="sample6_address" type="text" name="u_addr" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" readonly value="{{Auth::user()->u_addr}}"  />
                                        <x-button type="button" onclick="sample6_execDaumPostcode()" value="주소 검색" class="a_btn;btn btn-primary py-2 px-3;">주소 검색</x-button>
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-input id="s_lat" name="s_lat" type="hidden" class=" block w-full dark:bg-gray-600 dark:text-white"  />
                                        <x-input id="s_log" name="s_log" type="hidden" class=" block w-full dark:bg-gray-600 dark:text-white"   />
                                    </div>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex feature-h">
                            <span class="wrap-icon me-3">
                                <span class="icon-person"></span>
                            </span>
                            <div class="feature-text">
                                <h3 class="heading">내 이름</h3>
                                <p class="text-black-50">
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="name" value="{{ __('이름') }}" style="font-weight:700"/>
                                        <x-input id="name" name="name" maxlength="20" type="text" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->name}}" placeholder="한글 이름으로 작성" />
                                    </div>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex feature-h">
                            <span class="wrap-icon me-3">
                                <span class="icon-security"></span>
                            </span>
                            <div class="feature-text">
                                @if(Illuminate\Support\Facades\Auth::user()->seller_license)

                                <h3 class="heading">상호명</h3>
                                <p class="text-black-50">
                {{-- business name --}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="b_name" value="{{ __('상호명') }}" class="mt-3" style="font-weight:700"/>
                        <x-input id="b_name" type="text" name="b_name" maxlength="20" class="mt-1 block w-full dark:bg-gray-600 dark:text-white" value="{{Auth::user()->b_name}}" placeholder="상호명 작성"/>
                    </div>
                @endif
                @if(!(Illuminate\Support\Facades\Auth::user()->seller_license))
                    {{-- animal size --}}
                    <div class="col-span-6 sm:col-span-4 mt-3">
                        <x-label for="animal_size" value="{{ __('동물크기') }}" style="font-weight:700" />
                        {{-- <x-input id="animal_size" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.animal_size" autocomplete="animal_size" /> --}}
                        <label for="animal_size_lg" class="dark:text-white">대형</label>
                        <input type="radio" name="animal_size" id="animal_size_lg" @if(Auth::user()->animal_size === "1") checked @endif value="1" name="animal_size" class="dark:bg-gray-700">
                        <label for="animal_size_sm"  class="dark:text-white">중소형</label>
                        <input type="radio" name="animal_size" id="animal_size_sm" @if(Auth::user()->animal_size === "0") checked @endif value="0" name="animal_size" class="dark:bg-gray-700">
                    </div>
                @endif
                <x-button wire:loading.attr="disabled" id="submit_btn" class="s_btn;btn btn-primary py-2 px-3">
                    {{ __('저장') }}
                </x-button>
                                </p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row section-counter mt-5">
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
                </div>
            </div>
        </div>

        <div class="section">
            <div class="row justify-content-center footer-cta" data-aos="fade-up">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="mb-4">Be a part of our growing real state agents</h2>
                    <p>
                        <a href="{{ route('profile.chk_del_user') }}">
                            <x-danger-button class="btn btn-primary text-white py-3 px-4">회원 탈퇴
                            </x-danger-button>
                            </a>
                        <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">Apply for Real Estate agent</a>
                    </p>
                </div>
                <!-- /.col-lg-7 -->
            </div>
            <!-- /.row -->
        </div>

        <div class="section section-5 bg-light">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-6 mb-5">
                        <h2 class="font-weight-bold heading text-primary mb-4">
                            Our Agents
                        </h2>
                        <p class="text-black-50">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                            enim pariatur similique debitis vel nisi qui reprehenderit totam?
                            Quod maiores.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="h-100 person">
                            <img src="images/person_1-min.jpg" alt="Image" class="img-fluid" />

                            <div class="person-contents">
                                <h2 class="mb-0"><a href="#">James Doe</a></h2>
                                <span class="meta d-block mb-3">Real Estate Agent</span>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Facere officiis inventore cumque tenetur laboriosam, minus
                                    culpa doloremque odio, neque molestias?
                                </p>

                                <ul class="social list-unstyled list-inline dark-hover">
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-twitter"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-facebook"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-instagram"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="h-100 person">
                            <img src="images/person_2-min.jpg" alt="Image" class="img-fluid" />

                            <div class="person-contents">
                                <h2 class="mb-0"><a href="#">Jean Smith</a></h2>
                                <span class="meta d-block mb-3">Real Estate Agent</span>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Facere officiis inventore cumque tenetur laboriosam, minus
                                    culpa doloremque odio, neque molestias?
                                </p>

                                <ul class="social list-unstyled list-inline dark-hover">
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-twitter"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-facebook"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-instagram"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="h-100 person">
                            <img src="images/person_3-min.jpg" alt="Image" class="img-fluid" />

                            <div class="person-contents">
                                <h2 class="mb-0"><a href="#">Alicia Huston</a></h2>
                                <span class="meta d-block mb-3">Real Estate Agent</span>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Facere officiis inventore cumque tenetur laboriosam, minus
                                    culpa doloremque odio, neque molestias?
                                </p>

                                <ul class="social list-unstyled list-inline dark-hover">
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-twitter"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-facebook"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><span class="icon-instagram"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
