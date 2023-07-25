<style>
    .hidden{
        display: none;
    }
    #modal{
        width: 100%;
        top: 25%;
        left: 0;
        z-index: 9999;
        position: fixed;
        align-items: center;
        text-align: center;
        /* height: 100%; */
        /* position: fixed; */
        /* justify-content: center; */
    }
    /* #modal {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        z-index: 9999;
    }*/
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

    #modaldiv {
        margin: 0 auto;
        width: 320px;
        text-align: center;
        border: 1px solid #89a5ea;
        background-color: #929292;
        padding: 20px;
        border-radius: 8px;
    }
</style>
<x-app-layout>
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">아이디 찾기</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li id="use" sytle="color:white"><a href="{{ route('welcome') }}">메인</a></li>
                            <p> / </p>
                            <li id="sell">
                                아이디 찾기
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info">
                        <div class="address mt-2">
                            <i class="icon-room"></i>
                            <h4 class="mb-2">개발위치:</h4>
                            <p style="color:black">
                                대구광역시 중구 동성로<br />
                                그린컴퓨터 아트학원 5층
                            </p>
                        </div>

                        <div class="open-hours mt-4">
                            <i class="icon-clock-o"></i>
                            <h4 class="mb-2">연락가능 시간:</h4>
                            <p style="color:black">
                                Sunday-Friday:<br />
                                11:00 AM - 18:00 PM
                            </p>
                        </div>

                        <div class="email mt-4">
                            <i class="icon-envelope"></i>
                            <h4 class="mb-2">이메일:</h4>
                            <p style="color:black">faer9876@naver.com</p>
                        </div>

                        <div class="phone mt-4">
                            <i class="icon-phone"></i>
                            <h4 class="mb-2">전화번호:</h4>
                            <p style="color:black">+82 010 6625 6834</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                    <form id="findUsernameForm" action="{{ route('find-username.submit') }}" method="POST">
                        @csrf
                        <div class="col-6 mb-3">
                        <x-label for="email" class="block dark:text-white">{{ __('이메일') }}</x-label>
                        <x-input type="email" name="email" placeholder="이메일 입력" class="form-control"></x-input>
                        </div>
                        <x-button id="findUsernameBtn" class="btn btn-primary py-2 px-3" style="margin-top: 10px">아이디 찾기</x-button>
                    </form>

                    </div>
                </div>
                </div>
              </div>
    <div id="modal" class="hidden">
        <div id="modaldiv" style="border: 1px solid black; background-color:white;" class="rounded-lg p-6">
            <h1 id="modalTitle" class="text-lg font-bold mb-4"></h1>
            <p id="modalMessage"></p>
            <button id="modalCloseBtn" class="btn btn-primary py-2 px-3">
                닫기
            </button>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const findUsernameForm = document.getElementById("findUsernameForm");
    const modal = document.getElementById("modal");
    const modalTitle = document.getElementById("modalTitle");
    const modalMessage = document.getElementById("modalMessage");
    const modalCloseBtn = document.getElementById("modalCloseBtn");

    findUsernameForm.addEventListener("submit", function (event) {
        event.preventDefault();

        // AJAX 요청 보내기
        const formData = new FormData(findUsernameForm);
        fetch(findUsernameForm.action, {
            method: findUsernameForm.method,
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.hasOwnProperty("user")) {
                    // 아이디를 찾은 경우
                    modalTitle.textContent = "아이디 찾기 완료";
                    modalTitle.style.color = "black";
                    modalMessage.textContent = "아이디: " + data.user.u_id;
                    modalMessage.style.color = "black";
                    var modaldiv = document.getElementById('modaldiv');
                    var loginButton = document.querySelector("#modaldiv button.login-button");
                    if (!loginButton) {
                        loginButton = document.createElement("button");
                        loginButton.className = "btn btn-primary py-2 px-3";modalTitle.style.color = "blue";


                        // ***************** TODO : 로그인버튼, hidden으로 주고, 아이디를 찾은 경우에 없애기
                        loginButton.textContent = "로그인하러 가기";



                        loginButton.addEventListener("click", function () {
                            window.location.href = '/login';
                        });
                        modaldiv.appendChild(loginButton);
                    }
                } else if (data.hasOwnProperty("error")) {
                    // 사용자를 찾을 수 없는 경우
                    modalTitle.textContent = "에러";
                    modalMessage.textContent = data.error;
                }

                // 모달 창 열기
                modal.classList.remove("hidden");
            })
            .catch(error => {
                console.error(error);
            });
    });

    modalCloseBtn.addEventListener("click", function () {
        // 모달 창 닫기
        modal.classList.add("hidden");
    });
});
</script>
