<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="favicon.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}" />

    <link rel="stylesheet" href="{{ asset('tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />


    <title>
        Property &mdash; Free Bootstrap 5 Website Template by Untree.co
    </title>

    <style>
        p {
            color: white;
            margin: 0px 10px
        }

        li {
            color: gray;
        }

        .test {
            display: none;
        }

        .color {
            color: white;
        }

        .color2 {
            color: gray;
        }
    </style>
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <a href="index.html" class="logo m-0 float-start">Property</a>

                    <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                        <li><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="has-children active">
                            <a href="properties.html">property</a>
                            <ul class="dropdown">
                                <li><a href="#">Buy Property</a></li>
                                <li><a href="#">Sell Property</a></li>
                                <li class="has-children">
                                    <a href="#">Dropdown</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Sub Menu One</a></li>
                                        <li><a href="#">Sub Menu Two</a></li>
                                        <li><a href="#">Sub Menu Three</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>

                    <a href="#"
                        class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                        data-toggle="collapse" data-target="#main-navbar">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">회원가입</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li id="use">일반회원</li>
                            <p> / </p>
                            <li id="sell">
                                공인중개사
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section test" id="user">
        <div class="container">
            <div class="row text-left mb-5">
                <div class="col-12">
                    <h2 class="font-weight-bold heading text-primary mb-4">일반회원 약관</h2>
                </div>
                <div class="col-lg-6">
                    <p class="text-black-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                        enim pariatur similique debitis vel nisi qui reprehenderit totam?
                        Quod maiores.
                    </p>
                    <p class="text-black-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni
                        saepe, explicabo nihil. Est, autem error cumque ipsum repellendus
                        veniam sed blanditiis unde ullam maxime veritatis perferendis
                        cupiditate, at non esse!
                    </p>
                    <p class="text-black-50">
                        Enim, nisi labore exercitationem facere cupiditate nobis quod
                        autem veritatis quis minima expedita. Cumque odio illo iusto
                        reiciendis, labore impedit omnis, nihil aut atque, facilis
                        necessitatibus asperiores porro qui nam.
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-black-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni
                        saepe, explicabo nihil. Est, autem error cumque ipsum repellendus
                        veniam sed blanditiis unde ullam maxime veritatis perferendis
                        cupiditate, at non esse!
                    </p>
                    <p class="text-black-50">
                        Enim, nisi labore exercitationem facere cupiditate nobis quod
                        autem veritatis quis minima expedita. Cumque odio illo iusto
                        reiciendis, labore impedit omnis, nihil aut atque, facilis
                        necessitatibus asperiores porro qui nam.
                    </p>
                </div>
                <div id="show">
                    <div>동의합니까? 예: <input type="checkbox" id="checkbox"></div>
                    <a href="{{ route('user-register') }}" id="registerButton"
                        style="display: none;"><button>회원가입</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="section test" id="seller">
        <div class="container">
            <div class="row text-left mb-5">
                <div class="col-12">
                    <h2 class="font-weight-bold heading text-primary mb-4">공인중개사 약관</h2>
                </div>
                <div class="col-lg-6">
                    <p class="text-black-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                        enim pariatur similique debitis vel nisi qui reprehenderit totam?
                        Quod maiores.
                    </p>
                    <p class="text-black-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni
                        saepe, explicabo nihil. Est, autem error cumque ipsum repellendus
                        veniam sed blanditiis unde ullam maxime veritatis perferendis
                        cupiditate, at non esse!
                    </p>
                    <p class="text-black-50">
                        Enim, nisi labore exercitationem facere cupiditate nobis quod
                        autem veritatis quis minima expedita. Cumque odio illo iusto
                        reiciendis, labore impedit omnis, nihil aut atque, facilis
                        necessitatibus asperiores porro qui nam.
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-black-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni
                        saepe, explicabo nihil. Est, autem error cumque ipsum repellendus
                        veniam sed blanditiis unde ullam maxime veritatis perferendis
                        cupiditate, at non esse!
                    </p>
                    <p class="text-black-50">
                        Enim, nisi labore exercitationem facere cupiditate nobis quod
                        autem veritatis quis minima expedita. Cumque odio illo iusto
                        reiciendis, labore impedit omnis, nihil aut atque, facilis
                        necessitatibus asperiores porro qui nam.
                    </p>
                </div>
                <div id="show2">
                    <div>동의합니까? 예: <input type="checkbox" id="checkbox2"></div>
                    <a href="{{ route('seller-register') }}" id="registerButton2"
                        style="display: none;"><button>회원가입</button></a>
                </div>
            </div>
        </div>
    </div>



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

    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tiny-slider.js') }}"></script>
    <script src="{{ asset('aos.js') }}"></script>
    <script src="{{ asset('navbar.js') }}"></script>
    <script src="{{ asset('counter.js') }}"></script>
    <script src="{{ asset('custom.js') }}"></script>
</body>

</html>
<script>
    const useButton = document.getElementById('use');
    const userDiv = document.getElementById('user');
    let useClicked = false;

    useButton.addEventListener('click', function() {
        if (!useClicked) {
            useClicked = true;
            userDiv.classList.toggle('test');
            useButton.classList.toggle('color');
        }
    });

    const sellButton = document.getElementById('sell');
    const sellerDiv = document.getElementById('seller');
    let sellClicked = false;

    sellButton.addEventListener('click', function() {
        if (!sellClicked) {
            sellClicked = true;
            sellerDiv.classList.toggle('test');
            sellButton.classList.toggle('color');
        }
    });

    useButton.addEventListener('click', function() {
        if (sellClicked) {
            sellerDiv.classList.remove('test');
            sellButton.classList.remove('color');
            sellClicked = false;
        }
    });

    sellButton.addEventListener('click', function() {
        if (useClicked) {
            userDiv.classList.remove('test');
            useButton.classList.remove('color');
            useClicked = false;
        }
    });


    const checkbox = document.getElementById('checkbox');
    const registerButton = document.getElementById('registerButton');

    checkbox.addEventListener('click', function() {
        if (checkbox.checked) {
            registerButton.style.display = 'block';
        } else {
            registerButton.style.display = 'none';
        }
    });

    const checkbox2 = document.getElementById('checkbox2');
    const registerButton2 = document.getElementById('registerButton2');

    checkbox2.addEventListener('click', function() {
        if (checkbox2.checked) {
            registerButton2.style.display = 'block';
        } else {
            registerButton2.style.display = 'none';
        }
    });
</script>
