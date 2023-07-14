<x-app-layout>
    {{-- <div>
        <div id="scroll-container" class="scroll-item">
            <button type="button" style="z-index:10"><img id="btn1" src="{{asset('arrow-up-solid.png')}}"></button>
            <br>
            <button type="button" style="z-index:10"><img id="btn3" src="{{asset('arrow-down-solid.png')}}"></button>
            <div id="photo">
                @foreach ($photos as $photo)
                    <img class="photo-item" src="{{ asset($photo->url) }}" alt="{{ $photo->url }}">
                @endforeach
            </div>
        </div> --}}

    {{-- 건물 상세 위 큰 사진 --}}
        <div
        class="hero page-inner overlay"
        style="background-image: url('{{$mvp_photo->url}}')"
        >
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-9 text-center mt-5">
                        <h1 class="heading" data-aos="fade-up">
                        {{ $s_info->s_add }}
                        </h1>

                        <nav
                        aria-label="breadcrumb"
                        data-aos="fade-up"
                        data-aos-delay="200"
                        >
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">
                            <a href="properties.html">Properties</a>
                            </li>
                            <li
                            class="breadcrumb-item active text-white-50"
                            aria-current="page"
                            >
                            {{ $s_info->s_add }}
                            </li>
                        </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    {{-- 건물 상세 설명 --}}
        {{-- <div class="section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-7">
                        <div class="img-property-slide-wrap">
                            <div class="img-property-slide">
                                <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
                                <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
                                <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                <div class="col-lg-4">
                    <h2 class="heading text-primary fw-bold">{{ $s_info->s_add }}</h2>
                    <p class="meta fw-bold">{{ $s_info->s_name }}</p>
                    <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione
                    laborum quo quos omnis sed magnam id, ducimus saepe, debitis error
                    earum, iste dicta odio est sint dolorem magni animi tenetur.
                    </p>
                    <p class="text-black-50">
                    Perferendis eligendi reprehenderit, assumenda molestias nisi eius
                    iste reiciendis porro tenetur in, repudiandae amet libero.
                    Doloremque, reprehenderit cupiditate error laudantium qui, esse
                    quam debitis, eum cumque perferendis, illum harum expedita.
                    </p> --}}
<div class="site-section site-section-sm">
    <div class="container">
        <div class="row">
            <a><button class="btn btn-primary">수정</button></a>
            <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
            <div class="col-lg-8">
                <div>
                    <div class="slide-one-item home-slider owl-carousel">
                    @foreach ($photos as $photo)
                        <img class="img-fluid" src="{{ asset($photo->url) }}" alt="img">
                    @endforeach
                    {{-- <div><img src="images/hero_bg_1.jpg" alt="Image" class="img-fluid"></div>
                    <div><img src="images/hero_bg_2.jpg" alt="Image" class="img-fluid"></div>
                    <div><img src="images/hero_bg_3.jpg" alt="Image" class="img-fluid"></div> --}}
                    </div>
                </div>
                <div class="bg-white property-body border-bottom border-left border-right">
                <p>조회수 {{$s_info->hits}}</p>
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <strong class="text-success h1 mb-3">$1,000,500</strong>
                        </div>
                        <div class="col-md-6">
                            <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                            <strong class="d-block">Condo</strong>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                            <strong class="d-block">2018</strong>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                            <strong class="d-block">$520</strong>
                        </div>
                    </div>

            {{-- 상세 설명 --}}
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

        {{-- contact란 --}}
            <div class="col-lg-4">

                <div class="bg-white widget border rounded">

                    <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
                    <form action="" class="form-contact-agent">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="phone" class="btn btn-primary" value="Send Message" style="margin-top:20px">
                    </div>
                    </form>
                </div>

            {{-- 공인중개사 설명 --}}
                <div class="bg-white widget border rounded">
                    <h3 class="h4 text-black widget-title mb-3">{{ $user->b_name }}</h3>
                    <h3 class="mb-3 fw-bold fs-5 seller_name">{{ $user->name }}</h3>
                    <span>전화번호</span>
                    <p style="color:black!important">
                    {{$user->phone_no}}
                    </p>
                    <span>부동산 주소</span>
                    <p style="color:black!important">
                    {{$user->u_addr}}
                    </p>
                    </p>
                    <span>이메일</span>
                    <p style="color:black!important">
                    {{$user->email}}
                    </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit qui explicabo, libero nam, saepe eligendi. Molestias maiores illum error rerum. Exercitationem ullam saepe, minus, reiciendis ducimus quis. Illo, quisquam, veritatis.</p>
                </div>
            </div>
        </div>
    </div>
</div>

                    {{-- <!-- 공인중개사 설명 -->
                    <div class="d-block agent-box p-5">

                        <div class="text">
                            <div style="width:100px; height:100px; background:#e6e5e1; border-radius:50%; margin-bottom:16px;">
                                <img src="{{asset('house-solid.png')}}" style="width:70px; transform:translate(21%, 25%);"/>
                            </div>
                            <h3 class="mb-0 fw-bold fs-5 seller_name">{{ $user->name }}</h3>
                            <div class="meta mb-3">{{ $user->b_name }}</div>
                            <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Ratione laborum quo quos omnis sed magnam id ducimus saepe
                            </p>
                            <span>전화번호</span>
                            <p style="color:black!important">
                            {{$user->phone_no}}
                            </p>
                            <span>부동산 주소</span>
                            <p style="color:black!important">
                            {{$user->u_addr}}
                            </p>
                            </p>
                            <span>이메일</span>
                            <p style="color:black!important">
                            {{$user->email}}
                            </p>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div> --}}

        <div class="site-footer">
            <div class="container">
                <div class="row">
                <div class="col-lg-4">
                    <div class="widget">
                    <h3>Contact</h3>
                    <address>43 Raymouth Rd. Baltemoer, London 3910</address>
                    <ul class="list-unstyled links">
                        <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                        <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                        <li>
                        <a href="mailto:info@mydomain.com">info@mydomain.com</a>
                        </li>
                    </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="widget">
                    <h3>Sources</h3>
                    <ul class="list-unstyled float-start links">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                    <ul class="list-unstyled float-start links">
                        <li><a href="#">Partners</a></li>
                        <li><a href="#">Business</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Creative</a></li>
                    </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="widget">
                    <h3>Links</h3>
                    <ul class="list-unstyled links">
                        <li><a href="#">Our Vision</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>

                    <ul class="list-unstyled social">
                        <li>
                        <a href="#"><span class="icon-instagram"></span></a>
                        </li>
                        <li>
                        <a href="#"><span class="icon-twitter"></span></a>
                        </li>
                        <li>
                        <a href="#"><span class="icon-facebook"></span></a>
                        </li>
                        <li>
                        <a href="#"><span class="icon-linkedin"></span></a>
                        </li>
                        <li>
                        <a href="#"><span class="icon-pinterest"></span></a>
                        </li>
                        <li>
                        <a href="#"><span class="icon-dribbble"></span></a>
                        </li>
                    </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
                </div>
                <!-- /.row -->

                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <!-- 
                        **==========
                        NOTE: 
                        Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
                        **==========
                        -->

                        <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        . All Rights Reserved. &mdash; Designed with love by
                        <a href="https://untree.co">Untree.co</a>
                        <!-- License information: https://untree.co/license/ -->
                        </p>
                        <div>
                        Distributed by
                        <a href="https://themewagon.com/" target="_blank">themewagon</a>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /.container -->
        </div>
        <!-- /.site-footer -->

        <!-- Preloader -->
        <div id="overlayer"></div>
        <div class="loader">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

</x-app-layout>
