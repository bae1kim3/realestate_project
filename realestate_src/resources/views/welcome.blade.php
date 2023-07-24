<x-app-layout>
    <x-slot name="header">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding:wght@700&family=Orbit&family=Roboto+Mono:wght@600&display=swap" rel="stylesheet">
    </x-slot>
    <div class="hero">
        <div class="hero-slide">
            <div class="img overlay" style="background-image: url('images/hero_bg_3.jpg')"></div>
            <div class="img overlay" style="background-image: url('images/hero_bg_2.jpg')"></div>
            <div class="img overlay" style="background-image: url('images/hero_bg_1.jpg')"></div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        어떤 방을 찾으시나요? 펫 방이 찾아드립니다
                    </h1>
                    <div class="narrow-w form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                        <input type="text" class="form-control px-4" name="search" id="search" placeholder="주소나 지하철역 명으로 검색해 주세요" />
                        <button onclick="searchProperties()" class="btn btn-primary" style="width:100px;">검색</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="text-primary heading" style="font-weight: 500;">
                        최근 등록된 매물
                    </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p>
                        <a href="{{route('map.map')}}" target="_blank" class="btn btn-primary text-white py-3 px-4">지도에서 매물 검색</a>
                    </p>
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
{{-- 찜한 매물 출력 --}}
    @if(Auth::check() && session('seller_license') === null)
        <div class="section sec-testimonials">
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
        <section class="features-1">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="box-feature">
                            <span class="flaticon-house"></span>
                            <h3 class="mb-3">Our Properties</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Voluptates, accusamus.
                            </p>
                            <p><a href="#" class="learn-more">Learn More</a></p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                        <div class="box-feature">
                            <span class="flaticon-house"></span>
                            <h3 class="mb-3">Property for Sale</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Voluptates, accusamus.
                            </p>
                            <p><a href="#" class="learn-more">Learn More</a></p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="box-feature">
                            <span class="flaticon-house"></span>
                            <h3 class="mb-3">Real Estate Agent</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Voluptates, accusamus.
                            </p>
                            <p><a href="#" class="learn-more">Learn More</a></p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                        <div class="box-feature">
                            <span class="flaticon-house-1"></span>
                            <h3 class="mb-3">House for Sale</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Voluptates, accusamus.
                            </p>
                            <p><a href="#" class="learn-more">Learn More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- <div class="section section-4 bg-light">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-5">
                        <h2 class="font-weight-bold heading text-primary mb-4">
                            Let's find home that's perfect for you
                        </h2>
                        <p class="text-black-50">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                            enim pariatur similique debitis vel nisi qui reprehenderit.
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
                            <div class="feature-text">
                                <h3 class="heading">2M Properties</h3>
                                <p class="text-black-50">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Nostrum iste.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex feature-h">
                            <span class="wrap-icon me-3">
                                <span class="icon-person"></span>
                            </span>
                            <div class="feature-text">
                                <h3 class="heading">Top Rated Agents</h3>
                                <p class="text-black-50">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Nostrum iste.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex feature-h">
                            <span class="wrap-icon me-3">
                                <span class="icon-security"></span>
                            </span>
                            <div class="feature-text">
                                <h3 class="heading">Legit Properties</h3>
                                <p class="text-black-50">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Nostrum iste.
                                </p>
                            </div>
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
        </div> --}}

<script src="{{asset('welcome.js')}}"></script>
</x-app-layout>
