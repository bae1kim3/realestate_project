<style>
    .gal-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .slide-one-item.home-slider img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }
</style>

    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">

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


    <x-app-layout>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('{{$mvp_photo->url}}');" data-aos="fade" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-2">{{ $s_info->s_add }}</h1>
                    <p>{{$s_info->s_name}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                <a><button class="btn btn-primary btn-up">수정</button></a>

                    <div style="position:relative">
                        {{-- 찜 --}}
                            <input type="hidden" value="{{$s_info->s_no}}" id="s_no">
                            <input type="hidden" value="{{$id}}" id="id">
                            <input type="hidden" value="{{$likedFlg}}" id="likedFlg">

                            @if(!session('seller_license'))
                            {{-- <div style="position:absolute; z-index:100; right:10px; top:10px"> --}}
                                <div style="position:absolute; z-index:100; right:10px; top:10px; background-color:white; width:3em; height:3em; border-radius:50%; "></div>
                                    <span class="fa-regular fa-heart fa-2x emp-heart" id="emp_heart" onclick="storeLiked()" style="position:absolute; z-index:100; right:17px; top:20px;"></span>
                                    <span class="fa-solid fa-heart fa-2x full-heart" id="full_heart" onclick="deleteLiked()" style="position:absolute; z-index:100; right:17px; top:20px;"></span>
                                @endif
                            {{-- </div> --}}
                        {{-- 캐러셀 사진 --}}
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
                                <strong class="d-block summary-block-s">
                                    @switch($s_info->s_option)
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
                                                        @default
                                                            @break
                                                    @endswitch
                                </strong>
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
                <div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M278.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-64 64c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l9.4-9.4V224H109.3l9.4-9.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-9.4-9.4H224V402.7l-9.4-9.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l64 64c12.5 12.5 32.8 12.5 45.3 0l64-64c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-9.4 9.4V288H402.7l-9.4 9.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l9.4 9.4H288V109.3l9.4 9.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-64-64z"/></svg>
                    <span style="font-size:20px; color:black; ">{{ $s_info->s_size }} 평</span>
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 48c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16h80V400c0-26.5 21.5-48 48-48s48 21.5 48 48v64h80c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64zM0 64C0 28.7 28.7 0 64 0H320c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm88 40c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H104c-8.8 0-16-7.2-16-16V104zM232 88h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H232c-8.8 0-16-7.2-16-16V104c0-8.8 7.2-16 16-16zM88 232c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H104c-8.8 0-16-7.2-16-16V232zm144-16h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H232c-8.8 0-16-7.2-16-16V232c0-8.8 7.2-16 16-16z"/></svg>
                    <span style="font-size:20px; color:black;">{{ $s_info->s_fl }} 층</span>
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C43 0 0 43 0 96V352c0 48 35.2 87.7 81.1 94.9l-46 46C28.1 499.9 33.1 512 43 512H82.7c8.5 0 16.6-3.4 22.6-9.4L160 448H288l54.6 54.6c6 6 14.1 9.4 22.6 9.4H405c10 0 15-12.1 7.9-19.1l-46-46c46-7.1 81.1-46.9 81.1-94.9V96c0-53-43-96-96-96H96zM64 128c0-17.7 14.3-32 32-32h80c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM272 96h80c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32H272c-17.7 0-32-14.3-32-32V128c0-17.7 14.3-32 32-32zM64 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm288-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <span style="font-size:20px; color:black;">{{ $s_info->s_stai }} 역</span>
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM192 256h48c17.7 0 32-14.3 32-32s-14.3-32-32-32H192v64zm48 64H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V288 168c0-22.1 17.9-40 40-40h72c53 0 96 43 96 96s-43 96-96 96z"/></svg>
                    <span style="font-size:20px; color:black;"> 주차
                        @if ($data01->s_parking == 0)
                            불가능
                        @else
                            가능
                        @endif
                    </span>
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M132.7 4.7l-64 64c-4.6 4.6-5.9 11.5-3.5 17.4s8.3 9.9 14.8 9.9H208c6.5 0 12.3-3.9 14.8-9.9s1.1-12.9-3.5-17.4l-64-64c-6.2-6.2-16.4-6.2-22.6 0zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H64zm96 96a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM80 400c0-26.5 21.5-48 48-48h64c26.5 0 48 21.5 48 48v16c0 17.7-14.3 32-32 32H112c-17.7 0-32-14.3-32-32V400zm192 0c0-26.5 21.5-48 48-48h64c26.5 0 48 21.5 48 48v16c0 17.7-14.3 32-32 32H304c-17.7 0-32-14.3-32-32V400zm32-128a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zM356.7 91.3c6.2 6.2 16.4 6.2 22.6 0l64-64c4.6-4.6 5.9-11.5 3.5-17.4S438.5 0 432 0H304c-6.5 0-12.3 3.9-14.8 9.9s-1.1 12.9 3.5 17.4l64 64z"/></svg>
                    <span style="font-size:20px; color:black;">엘레베이터
                    @if ($data01->s_ele== 0)
                        없음
                    @else
                        있음
                    @endif
                    </span>
                    </div>
                </div>

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
        <div class="col-lg-4 seller-info">


            <div class="bg-white widget border rounded seller-detail" style="margin-top:50px">
                <h3 class="h4 text-black widget-title mb-3">공인중개사 정보</h3>
                <h3 class="h4 text-black widget-title mb-3">{{ $user->b_name }}</h3>
                <h3 class="mb-3 fw-bold fs-5 seller-name">{{ $user->name }}</h3>
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
            <h4 class="text-black widget-title mb-3">위치</h4>
            <p>{{ $s_info->s_add }}</p>
            <div id="map" style="width: 100%; height: 400px; margin-bottom:30px;"></div>
            <input type="hidden" value="{{ $s_info->s_name }}" id="s_name"/>
            <input type="hidden" value="{{ $s_info->s_log }}" id="s_log"/>
            <input type="hidden" value="{{ $s_info->s_lat }}" id="s_lat"/>
            <div class="map-btn">
                <div class="map-btn-con">
                    <button class="shop-btn" id="getshop">
                        <i class="fa-solid fa-paw fa-2x"></i>
                        <p>반려동물 용품점</p>
                    </button>
                    <button class="hosp-btn" id="gethosp">
                        <i class="fa-solid fa-house-chimney-medical fa-2x"></i>
                        <p>동물 병원</p>
                    </button>
                    <button class="walk-btn" id="getwalk">
                        <i class="fa-solid fa-seedling fa-2x"></i>
                        <p>산책로</p>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</x-app-layout>

{{-- del jy 0718 --}}
{{-- <script>
            function changeFullHeart() {


            // 서버로 보낼 데이터 생성
                var requestData = {
                    s_no: {{ session()->get('s_no') }},
                    id: {{ Auth::user()->id }}
                };

                // Ajax 요청 설정
                var url = '/like'; // 요청을 보낼 엔드포인트 URL
                fetch(url, {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                })
                .then(function(response) {
                    if (response.ok) {
                    return response.json();
                    } else {
                    throw new Error('Error: ' + response.status);
                    }
                })
                .then(function(data) {
                    // 성공적으로 요청을 처리한 후 수행할 동작을 작성합니다.
                    console.log('찜하기 성공');
                })
                .catch(function(error) {
                    // 요청 처리 중 에러가 발생한 경우 수행할 동작을 작성합니다.
                    console.log('에러 발생: ' + error.message);
                });
            }


            function changeEmpHeart() {
                document.getElementById('emp-heart').classList.add('none');
                document.getElementById('full-heart').classList.remove('none');

            };
        </script> --}}


{{-- 지도 --}}
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services"></script>



    <script src="{{asset('detail_map.js')}}"></script>
    <script src="https://kit.fontawesome.com/e615ee2f7e.js" crossorigin="anonymous"></script>
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

    <script src="{{asset('jjim.js')}}"></script>






