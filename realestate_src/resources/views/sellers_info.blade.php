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
<x-app-layout>
    <div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">공인중개사 목록</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">메인</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                공인중개사 목록
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section sec-testimonials" style="padding-bottom:3rem">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0" style="font-family: 'S-CoreDream-6Bold';">
                        공인중개사 목록
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
                    @foreach ($users as $use)
                    <div class="item">
                        <div class="testimonial">
                            <img src="{{ asset($photo->url) }}" alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
                            <div class="rate">
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                            </div>
                            <h3 class="h5 text-primary mb-4">{{ $use->name }}</h3>
                            <blockquote>
                                <p>부동산 이름 : {{ $use->b_name }}</p>
                                <p>연락처 : <span id="phoneNo">{{ $use->phone_no }}</span></p>
                                <p>가입날짜 : {{ date('Y-m-d',strtotime($use->created_at)) }}</p>
                            </blockquote>
                            {{-- <p class="text-black-50">Designer, Co-founder</p> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>




    <div class="section" style="padding-bottom:5rem">
        <div class="container">
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
                </div>
                <div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
                    <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
                </div>
            </div>
            <div class="row section-counter mt-5">
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">{{$user_n}}</span></span>
                        <span class="caption text-black-50"># 일반 회원 수</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">{{$seller_n}}</span></span>
                        <span class="caption text-black-50"># 공인중개사 수</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">{{$hits}}</span></span>
                        <span class="caption text-black-50"># 토탈 조회수</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">{{$expen}}</span></span>
                        <span class="caption text-black-50"># 가장 비싼 매물</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
