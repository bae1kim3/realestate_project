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