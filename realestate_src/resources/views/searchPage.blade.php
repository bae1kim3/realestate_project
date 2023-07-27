<x-app-layout>
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
                    <form action="{{route('search.post')}}" method="post">
                        <div class="narrow-w form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                            <input type="text" class="form-control px-4" name="search" id="search" placeholder="주소나 지하철역 명으로 검색해 주세요" />
                            <button type="submit"  class="btn btn-primary py-2 px-4">Search</button>
                            <label for="animal_size">대형동물 가능</label>
                            <input type="checkbox" id="animal_size" name="animal_size" value="1">
                            <label for="p_month">월세</label>
                            <input type="checkbox" id="p_month" name="p_type" value="월세">
                            <label for="p_jeonse">전세</label>
                            <input type="checkbox" id="p_jeonse" name="p_type" value="전세">
                            <label for="p_sell">매매</label>
                            <input type="checkbox" id="p_sell" name="p_type" value="매매">
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
                        검색된 매물
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
                    @foreach($chk_search as $photo)
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
</x-app-layout>