


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/mediaelementplayer.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/fl-bigmug-line.css')}}">
    
    
    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('detail.css')}}">
    

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('{{$mvp_photo->url}}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
                    <h1 class="mb-2">{{ $s_info->s_add }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                <a><button class="btn btn-primary btn-up">수정</button></a>
                    <div>
                        <div class="slide-one-item home-slider owl-carousel">
                            @foreach ($photos as $photo)
                                    <img class="img-fluid" src="{{ asset($photo->url) }}" alt="img">
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white property-body border-bottom border-left border-right">
                        <p class="hits">조회수 {{$s_info->hits}}</p>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <strong class="text-success h1 mb-3 price">
                                    @if($s_info->p_month)
                                    {{ $s_info->p_deposit }} / {{ $s_info->p_month }}
                                    @else
                                    {{ $s_info->p_deposit }}
                                    @endif
                                </strong>
                                <p>만원</p>
                            </div>
                        </div>
                        <div class="row mb-5 summary-block">
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">판매 유형</span>
                                <strong class="d-block summary-block-s">{{ $s_info->s_type }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">건물 유형</span>
                                <strong class="d-block summary-block-s">건물유형 넣기!!!!!!!!!!!</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">대형견(25kg 이상) 입주</span>
                                <strong class="d-block summary-block-s">
                                    @if ($s_info->animal_size == 0)
                                        가능
                                    @else
                                        불가능
                                    @endif
                                </strong>
                            </div>
                        </div>

            {{-- 상세 정보 --}}
                
                <h2 class="h4 text-black">More Info</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda aperiam perferendis deleniti vitae asperiores accusamus tempora facilis sapiente, quas! Quos asperiores alias fugiat sunt tempora molestias quo deserunt similique sequi.</p>
                <p>Nisi voluptatum error ipsum repudiandae, autem deleniti, velit dolorem enim quaerat rerum incidunt sed, qui ducimus! Tempora architecto non, eligendi vitae dolorem laudantium dolore blanditiis assumenda in eos hic unde.</p>
                <p>Voluptatum debitis cupiditate vero tempora error fugit aspernatur sint veniam laboriosam eaque eum, et hic odio quibusdam molestias corporis dicta! Beatae id magni, laudantium nulla iure ea sunt aliquam. A.</p>

                <div class="row no-gutters mt-5">
                    <div class="col-12">
                        <h2 class="h4 text-black mb-3">Gallery</h2>
                    </div>
                    @foreach ($photos as $photo)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ asset($photo->url) }}" class="image-popup gal-item"><img src="{{ asset($photo->url) }}" alt="Image" class="img-fluid"></a>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>

        {{-- 공인중개사 정보 --}}
        <div class="col-lg-4 seller-info" style=" margin-top: 50px!important;">
            <div class="bg-white widget border rounded seller-detail">
                <h3 class="h4 text-black widget-title mb-3">{{ $user->b_name }}</h3>
                <h3 class="mb-3 fw-bold fs-5 seller_name">{{ $user->name }}</h3>
                <span>전화번호</span>
                <p>
                {{$user->phone_no}}
                </p>
                <span>부동산 주소</span>
                <p>
                {{$user->u_addr}}
                </p>
                </p>
                <span>이메일</span>
                <p>
                {{$user->email}}
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit qui explicabo, libero nam, saepe eligendi. Molestias maiores illum error rerum. Exercitationem ullam saepe, minus, reiciendis ducimus quis. Illo, quisquam, veritatis.</p>
            </div>
        </div>
        </div>
    </div>
    </div>

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/mediaelement-and-player.min.js')}}"></script>
    <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/aos.js')}}"></script>
    <script src="{{asset('js/circleaudioplayer.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    @include('layouts.footer')
        

