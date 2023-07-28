    <style>
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
                        <h1 class="heading" data-aos="fade-up">회원가입</h1>
                        <br>
                        <h4 class="heading" data-aos="fade-up">일반회원과 공인중개사중 하나를 선택하세요</h4>
                        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                            <ol class="breadcrumb text-center justify-content-center">
                                <li id="use" style="font-size: 30px; font-weight: bolder;">일반회원</li>
                                <p style="color:white; margin:0px 10px; font-size:30px"> / </p>
                                <li id="sell" style="font-size: 30px; font-weight: bolder;">
                                    공인중개사
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="section displayNone" id="user">
            <div class="container">
                <div class="row text-left mb-5">
                    <div class="col-12">
                        <h2 class="font-weight-bold heading text-primary mb-4">일반회원 약관</h2>
                    </div>
                    @include('terms2')
                    <div id="show">
                        <br>
                        <label>
                            <input type="checkbox" id="agreeCheckbox" disabled>
                            약관에 동의합니다.
                        </label>
                        <br>
                        <a href="{{ route('user-register') }}" id="registerButton" style="display: none;"><button class="btn btn-primary py-2 px-3">회원가입</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="section displayNone" id="seller">
            <div class="container">
                <div class="row text-left mb-5">
                    <div class="col-12">
                        <h2 class="font-weight-bold heading text-primary mb-4">공인중개사 약관</h2>
                    </div>
                    {{-- <div class="col-lg-6">
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
                </div> --}}

                    @include('terms1')
                    <div id="show2">
                        <br>
                        <label>
                            <input type="checkbox" id="agreeCheckbox2" disabled>
                            약관에 동의합니다.
                        </label>
                        <br>
                        <a href="{{ route('seller-register') }}" id="registerButton2" style="display: none;"><button class="btn btn-primary py-2 px-3">회원가입</button></a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const useButton = document.getElementById('use');
            const userDiv = document.getElementById('user');
            let useClicked = false;
            const sellButton = document.getElementById('sell');
            const sellerDiv = document.getElementById('seller');
            let sellClicked = false;

            useButton.addEventListener('click', function() {
                useButton.classList.add('color');
                sellerDiv.classList.add('displayNone');
                sellButton.classList.remove('color');
                if (userDiv.classList.value.indexOf('displayNone')) {
                    userDiv.classList.remove('displayNone');
                }
            });


            sellButton.addEventListener('click', function() {
                userDiv.classList.add('displayNone');
                sellButton.classList.add('color');
                useButton.classList.remove('color');
                if (sellerDiv.classList.value.indexOf('displayNone')) {
                    sellerDiv.classList.remove('displayNone');
                }
            });

            // useButton.addEventListener('click', function() {
            //     if (sellClicked) {
            //         sellerDiv.classList.remove('displayNone');
            //         sellButton.classList.remove('color');
            //         sellClicked = false;
            //     }
            // });

            // sellButton.addEventListener('click', function() {
            //     if (useClicked) {
            //         userDiv.classList.remove('displayNone');
            //         useButton.classList.remove('color');
            //         useClicked = false;
            //     }
            // });

            document.addEventListener("DOMContentLoaded", function() {
                const termsTextarea = document.getElementById("termsTextarea2");
                const agreeCheckbox = document.getElementById("agreeCheckbox");
                const registerButton = document.getElementById("registerButton");

                function checkScrollPosition() {
                    const scrolledRatio =
                        termsTextarea.scrollTop / (termsTextarea.scrollHeight - termsTextarea.clientHeight);

                    if (scrolledRatio >= 0.95) {
                        agreeCheckbox.disabled = false;
                        registerButton.disabled = false;
                    }
                }

                termsTextarea.addEventListener("scroll", checkScrollPosition);
            });

            const checkbox = document.getElementById('agreeCheckbox');
            const registerButton = document.getElementById('registerButton');

            checkbox.addEventListener('click', function() {
                if (checkbox.checked) {
                    registerButton.style.display = 'block';
                } else {
                    registerButton.style.display = 'none';
                }
            });

            const checkbox2 = document.getElementById('agreeCheckbox2');
            const registerButton2 = document.getElementById('registerButton2');

            checkbox2.addEventListener('click', function() {
                if (checkbox2.checked) {
                    registerButton2.style.display = 'block';
                } else {
                    registerButton2.style.display = 'none';
                }
            });

            document.addEventListener("DOMContentLoaded", function() {
                const termsTextarea = document.getElementById("termsTextarea");
                const agreeCheckbox = document.getElementById("agreeCheckbox2");
                const registerButton = document.getElementById("registerButton2");

                function checkScrollPosition() {
                    const scrolledRatio =
                        termsTextarea.scrollTop / (termsTextarea.scrollHeight - termsTextarea.clientHeight);

                    if (scrolledRatio >= 0.95) {
                        agreeCheckbox.disabled = false;
                        registerButton.disabled = false;
                    }
                }

                termsTextarea.addEventListener("scroll", checkScrollPosition);
            });

        </script>

    </x-app-layout>
