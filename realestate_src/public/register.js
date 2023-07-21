// function checkli() {
//     var userli = document.getElementById('seller_license').value; // Corrected spelling
//     if (userli) {
//         url = "{{ route('checkLicense') }}" + "?seller_license=" + userli;;
//         window.open(url, "chkid", "width=700,height=500");
//     } else {
//         alert('라이센스 번호를 입력하세요');
//     }
// }

// function checkid() {
//     var userid = document.getElementById('u_id').value;
//     if (userid) {
//         url = "{{ route('check-id') }}" + "?u_id=" + userid;
//         window.open(url, "chkid", "width=700,height=400");
//     } else {
//         alert('아이디를 입력하세요');
//     }
// }

function toggleDropdown() {
    var dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('show');
}

function selectOption(value, label) {
    document.getElementById('selectedOption').value = value;
    document.querySelector('.dropdown-toggle').innerHTML = label + '<span class="arrow">&#9662;</span>';

    var dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.remove('show');

    var pwQuestionInput = document.querySelector('input[name="pw_question"]');
    pwQuestionInput.value = option;
}

// 이하 아래 실시간 유효성 검사

// 이름
function validateName() {
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('name-error');
    const name = nameInput.value.trim();

    if (name.length === 0) {
        nameError.textContent = '이름을 입력해주세요.';
    } else if (!/^[가-힣]+$/.test(name)) {
        nameError.textContent = '한글만 입력 가능합니다.';
    } else if (name.length > 20) {
        nameError.textContent = '20자 이하로 작성해 주세요.';
    } else {
        nameError.textContent = '';
    }
}

// 아이디   
function validateUserID() {
    const userIDInput = document.getElementById('u_id');
    const userIDError = document.getElementById('u_id-error');
    const userID = userIDInput.value.trim();

    if (userID.length === 0) {
        userIDError.textContent = '아이디를 입력해주세요.';
    } else if (!/^[a-zA-Z0-9]{5,12}$/.test(userID)) {
        userIDError.textContent = '영문, 숫자로만 이루어진 6~20자로 작성해 주세요.';
    } else {
        userIDError.textContent = '';
    }
}

// 이메일
function validateEmail() {
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-error');
    const email = emailInput.value.trim();

    if (!/^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        emailError.textContent = '유효한 이메일 형식을 입력해주세요.';
    } else if (email.length > 30) {
        emailError.textContent = '이메일은 최대 30글자까지 입력 가능합니다.';
    } else {
        emailError.textContent = '';
    }
}

// 비밀번호
function validatePassword() {
    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('password-error');
    const password = passwordInput.value.trim();

    if (password.length < 8 || password.length > 20) {
        passwordError.textContent = '비밀번호는 8~20글자로 작성해 주세요.';
    } else if (!/(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[~!@#$%^&*]).{8,20}/.test(password)) {
        passwordError.textContent = '비밀번호는 대문자, 소문자, 숫자, 특수문자(~, !, @, #, $, %, ^, &, *)를 최소 1글자씩 포함해야 합니다.';
    } else {
        passwordError.textContent = '';
    }
}

// 비밀번호 확인
function validatePasswordConfirmation() {
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const passwordConfirmationError = document.getElementById('password_confirmation-error');
    const password = passwordInput.value.trim();
    const passwordConfirmation = passwordConfirmationInput.value.trim();

    if (password !== passwordConfirmation) {
        passwordConfirmationError.textContent = '비밀번호와 일치하지 않습니다.';
    } else {
        passwordConfirmationError.textContent = '';
    }
}

// 비밀번호 질문 답변
function validateAnswer() {
    const answerInput = document.getElementById('pw_answer');
    const answerError = document.getElementById('pw_answer-error');
    const answer = answerInput.value.trim();

    if (answer.length < 1 || answer.length > 20) {
        answerError.textContent = '질문 답변은 1~20글자로 작성해 주세요.';
    } else if (!/^[가-힣]+$/.test(answer)) {
        answerError.textContent = '질문 답변은 한글로만 해주세요.';
    } else {
        answerError.textContent = '';
    }
}

// 전화번호
function validatePhoneNumber() {
    const phoneNumberInput = document.getElementById('phone_no');
    const phoneNumberError = document.getElementById('phone_no-error');
    const phoneNumber = phoneNumberInput.value.trim();

    if (!/^\d{10,11}$/.test(phoneNumber)) {
        phoneNumberError.textContent = '전화번호는 "-"을 뺀 숫자로만 작성해 주세요.';
    } else {
        phoneNumberError.textContent = '';
    }
}

// 상호명
function validateBusinessName() {
    const businessNameInput = document.getElementById('b_name');
    const businessNameError = document.getElementById('b_name-error');
    const businessName = businessNameInput.value.trim();

    if (businessName.length > 20) {
        businessNameError.textContent = '상호명은 최대 20글자까지 입력 가능합니다.';
    } else {
        businessNameError.textContent = '';
    }
}

// 유효성 검사 실행
document.getElementById('name').addEventListener('input', validateName);
document.getElementById('u_id').addEventListener('input', validateUserID);
document.getElementById('email').addEventListener('input', validateEmail);
document.getElementById('password').addEventListener('input', validatePassword);
document.getElementById('password_confirmation').addEventListener('input', validatePasswordConfirmation);
document.getElementById('pw_answer').addEventListener('input', validateAnswer);
document.getElementById('b_name').addEventListener('input', validateBusinessName);
document.getElementById('phone_no').addEventListener('input', validatePhoneNumber);
