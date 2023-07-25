<x-app-layout>
    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">공인중개사 목록</h1>

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
                  공인중개사 목록
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section sec-testimonials">
        <div class="container">
          <div class="row mb-5 align-items-center">
            <div class="col-md-6">
              <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                공인중개사 목록
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
              @foreach ($users as $use)
                <div class="item">
                  <div class="testimonial">
                    <img
                      src="{{ asset($photo->url) }}"
                      alt="Image"
                      class="img-fluid rounded-circle w-25 mb-4"
                    />
                    <div class="rate">
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-warning"></span>
                    </div>
                    <h3 class="h5 text-primary mb-4">{{ $use->name }}</h3>
                    <blockquote>
                      부동산 이름 : {{ $use->b_name }}
                      <p>
                        &ldquo;Far far away, behind the word mountains, far from the
                        countries Vokalia and Consonantia, there live the blind
                        texts. Separated they live in Bookmarksgrove right at the
                        coast of the Semantics, a large language ocean.&rdquo;
                      </p>
                    </blockquote>
                    <p class="text-black-50">Designer, Co-founder</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>



            <div class="section pt-0">
                <div class="container">
                    <h1>이달의 매물</h1>
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
                          <h3 class="heading">건물 이름</h3>
                          <p class="text-black-50">
                            {{ $bild->s_name }}
                          </p>
                        </div>
                      </div>

                      <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                          <span class="icon-person"></span>
                        </span>
                        <div class="feature-text">
                          <h3 class="heading">건물 위치</h3>
                          <p class="text-black-50">
                            {{$bild->s_add}}
                          </p>
                        </div>
                      </div>

                      <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                          <span class="icon-security"></span>
                        </span>
                        <div class="feature-text">
                          <h3 class="heading">조회수</h3>
                          <p class="text-black-50">
                            {{$bild->hits}} 회
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="section">
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
                    <div
                      class="col-6 col-sm-6 col-md-6 col-lg-3"
                      data-aos="fade-up"
                      data-aos-delay="300"
                    >
                      <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"
                          ><span class="countup text-primary">2917</span></span
                        >
                        <span class="caption text-black-50"># of Buy Properties</span>
                      </div>
                    </div>
                    <div
                      class="col-6 col-sm-6 col-md-6 col-lg-3"
                      data-aos="fade-up"
                      data-aos-delay="400"
                    >
                      <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"
                          ><span class="countup text-primary">3918</span></span
                        >
                        <span class="caption text-black-50"># of Sell Properties</span>
                      </div>
                    </div>
                    <div
                      class="col-6 col-sm-6 col-md-6 col-lg-3"
                      data-aos="fade-up"
                      data-aos-delay="500"
                    >
                      <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"
                          ><span class="countup text-primary">38928</span></span
                        >
                        <span class="caption text-black-50"># of All Properties</span>
                      </div>
                    </div>
                    <div
                      class="col-6 col-sm-6 col-md-6 col-lg-3"
                      data-aos="fade-up"
                      data-aos-delay="600"
                    >
                      <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"
                          ><span class="countup text-primary">1291</span></span
                        >
                        <span class="caption text-black-50"># of Agents</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</x-app-layout>
