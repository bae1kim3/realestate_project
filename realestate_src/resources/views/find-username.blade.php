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
                  아이디 찾기
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section bg-light">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row justify-content-center">
                <div class="col-lg-20 text-center mt-5">
                    <div class="box-feature mb-4">
              <span class="icon-check"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                아이디 찾기
             </h3>
              <p class="text-black-50">
               아이디를 찾으려면 이메일을 입력해 주세요
              </p>
              <div>
                <form id="findUsernameForm" action="{{ route('find-username.submit') }}" method="POST">
                    @csrf
                    <x-label for="email" class="block dark:text-white">{{ __('이메일') }}</x-label>
                    <x-input type="email" name="email" placeholder="이메일 입력" class="block mt-1 w-full dark:bg-gray-700 dark:text-white"></x-input>
                    <br>
                    <x-button id="findUsernameBtn" class="btn btn-primary py-2 px-3" style="margin-top: 10px">아이디 찾기</x-button>
                </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="modal" class="hidden">
        <div id="modaldiv" style="border: 1px solid #89a5ea; background-color:#929292;" class="rounded-lg p-6">
            <h1 id="modalTitle" class="text-lg font-bold mb-4"></h1>
            <p id="modalMessage"></p>
            <button id="modalCloseBtn" class="mt-6 bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
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
                    modalMessage.textContent = "아이디: " + data.user.u_id;
                    var modaldiv = document.getElementById('modaldiv');
                    var loginButton = document.querySelector("#modaldiv button.login-button");
                    if (!loginButton) {
                        loginButton = document.createElement("button");
                        loginButton.className = "mt-6 bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded login-button";




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
