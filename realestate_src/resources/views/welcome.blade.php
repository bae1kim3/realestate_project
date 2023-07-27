<x-app-layout>
    <x-slot name="header">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding:wght@700&family=Orbit&family=Roboto+Mono:wght@600&display=swap" rel="stylesheet">
        <style>
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

    </style>
    </x-slot>
    <div class="hero">
        <div class="hero-slide">
            <div class="img overlay" style="background-image: url('images/AdobeStock_481320874_Preview.jpeg')"></div>
            <div class="img overlay" style="background-image: url('images/AdobeStock_622111621_Preview.jpeg')"></div>
            <div class="img overlay" style="background-image: url('images/AdobeStock_390828488_Preview.jpeg')"></div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h2 class="heading" data-aos="fade-up">
                        어떤 방을 찾으시나요? 펫 방이 찾아드립니다
                    </h2>
                    <form action="{{route('search.get')}}" method="get">
                        <div class="narrow-w form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                            <input type="text" class="form-control px-4" name="search" id="search" placeholder="주소나 지하철역 명으로 검색해 주세요" />
                            <button type="submit"  class="btn btn-primary py-2 px-4">Search</button>
                            <label for="animal_size">대형동물 가능</label>
                            <input type="checkbox" id="animal_size" name="animal_size" value="1">
                            <label for="p_month">월세</label>
                            <input type="checkbox" id="p_month" name="p_month" value="월세">
                            <label for="p_jeonse">전세</label>
                            <input type="checkbox" id="p_jeonse" name="p_jeonse" value="전세">
                            <label for="p_sell">매매</label>
                            <input type="checkbox" id="p_sell" name="p_sell" value="매매">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="text-primary heading" style="font-family:'S-CoreDream-6Bold';">
                        최근 등록된 매물
                    </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div style="display:flex-end">
                        <div>
                            <span>
                                <a href="{{route('map.map')}}" target="_blank" class="btn btn-primary text-white py-3 px-4">지도에서 매물 검색</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="property-slider-wrap">
                        <div class="property-slider" id="itemContainer" style="max-width:8000px;">
                            @foreach($photos as $photo)
                            <div class="property-item" style="width: 350px;">
                                <a href="{{route('struct.detail',['s_no'=>$photo->s_no])}}" class="img">
                                    <img src="{{asset($photo->url)}}" alt="Image" class="img-fluid" style="width: 350px; height: 300px; margin-bottom: 50px;" />
                                </a>

                                <div class="property-content">
                                    <div class="price mb-2"><span>{{ $photo->s_name }}</span></div>
                                    <div>
                                        <span class="d-block mb-2 text-black-50">{{ $photo->s_add }}</span>
                                        <span class="city d-block mb-3">{{ number_format($photo->p_deposit) }}
                                            @if ($photo->s_type === '월세')
                                            / {{ number_format($photo->p_month) }}
                                            @endif
                                        </span>

                                        <div class="specs d-flex mb-4">
                                            <span class="d-block d-flex align-items-center me-3">
                                                <span class="icon-building me-2"></span>
                                                <span class="caption">
                                                    @switch($photo->s_option)
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
                                            </span>
                                            <span class="d-block d-flex align-items-center">
                                                <span class="fa-solid fa-dog me-2"></span>
                                                <span class="caption"> 대형동물
                                                    @switch($photo->animal_size)
                                                    @case(0)
                                                    <strong>X</strong>
                                                    @break
                                                    @case(1)
                                                    <strong>O</strong>
                                                    @break
                                                    $@default

                                                    @endswitch
                                                </span>
                                            </span>
                                        </div>

                                        <a href="{{route('struct.detail',['s_no'=>$photo->s_no])}}" class="btn btn-primary py-2 px-3">매물 보러가기</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- .item -->
                        </div>

                        <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                            <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">이전</span>
                            <span class="next" data-controls="next" aria-controls="property" tabindex="-1">다음</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 찜한 매물 출력 --}}
    @if(Auth::check() && session('seller_license') === null)
    <div class="section sec-testimonials">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <h2 class=" heading mb-4 mb-md-0" style="font-family:'S-CoreDream-6Bold';">
                        찜한 매물
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
                    @if(!empty($liked_info[0]))
                    @foreach($liked_info as $info)
                    <div class="item">
                        <div class="testimonial">
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
                    <span>찜한 매물이 없습니다</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($photo)
    <div class="section pt-0">
        <div class="container">
            <h2 class="mb-5" style="font-weight:800; font-family: 'S-CoreDream-6Bold';">이달의 매물</h2>
            <div class="row justify-content-between mb-5">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="img-about dots">
                        <a href="{{route('struct.detail',['s_no'=>$photo->s_no])}}" class="img">
                            <img class="img-fluid" src="{{ asset($photo->url) }}" alt="img" style="width: 80%;height:80%">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-home2"></span>
                        </span>
                        <div class="feature-text">
                            <p class="text-black-50" style="margin-bottom:8px">
                                건물 이름
                            </p>
                            <h3 class="heading">{{ $building->s_name }}</h3>
                        </div>
                    </div>

                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-person"></span>
                        </span>
                        <div class="feature-text">
                            <p class="text-black-50" style="margin-bottom:8px">
                                건물 위치
                            </p>
                            <h3 class="heading">{{$building->s_add}}</h3>
                        </div>
                    </div>

                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-security"></span>
                        </span>
                        <div class="feature-text">
                            <p class="text-black-50" style="margin-bottom:8px">
                                조회수
                            </p>
                            <h3 class="heading">{{$building->hits}} 회</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="features-1">
        <h1 style="font-family:'S-CoreDream-6Bold'; margin-bottom:16px">개발진</h1>
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <h3 style="font-family: 'S-CoreDream-3Light';">조장</h3>
                    <div class="box-feature">
                        <img src="images/person_1-min.jpg" alt="Image" class="img-fluid" style="margin-bottom:16px;"/>
                        <h3 class="mb-3"  style="margin-bottom:16px;"/>배창현</h3>
                        <p>
                            API, 관리자페이지, 지도 담당
                        </p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <h3  style="font-family: 'S-CoreDream-3Light';">팀원</h3>
                    <div class="box-feature">
                        <img src="images/person_2-min.jpg" alt="Image" class="img-fluid" style="margin-bottom:16px;"/>
                        <h3 class="mb-3" style="margin-bottom:16px;">김영범</h3>
                        <p>
                            디자인, 로그인, 회원가입 담당
                        </p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <h3  style="font-family: 'S-CoreDream-3Light';">팀원</h3>
                    <div class="box-feature">
                        <img src="images/person_3-min.jpg" alt="Image" class="img-fluid" style="margin-bottom:16px;"/>
                        <h3 class="mb-3" style="margin-bottom:16px;">김민규</h3>
                        <p>
                            지도페이지, 메인페이지 담당
                        </p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <h3  style="font-family: 'S-CoreDream-3Light';">팀원</h3>
                    <div class="box-feature">
                        <img src="images/person_4-min.jpg" alt="Image" class="img-fluid" style="margin-bottom:16px;"/>
                        <h3 class="mb-3" style="margin-bottom:16px;">김주영</h3>
                        <p>
                            디테일 페이지, 수정페이지 담당
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif


    <script src="{{asset('welcome.js')}}"></script>
</x-app-layout>
