// var confirmBtn = document.getElementById("confirmBtn");
// const withdrawal = function() {
//     confirmBtn.addEventListener("click", function() {
//             let form = document.getElementById("deleteForm");
//             form.submit();
//     });

// }

const confirmBtn = document.getElementById("confirmBtn");
const modalCloseBtn = document.getElementById("modalCloseBtn");
const modal = document.getElementById("modal");
const delBtn = document.getElementById("delBtn");

// 모달 창 열기
const clickDel = function() {
    delBtn.addEventListener("click", function() {
    modal.classList.remove("hidden");
});
}
const withdrawal = function() {
    confirmBtn.addEventListener("click", function() {
            let form = document.getElementById("deleteForm");
            form.submit();
            return false;
    });
}
const closeModal = function() {modalCloseBtn.addEventListener("click", function() {
    // 모달 창 닫기
    modal.classList.add("hidden");
});
}
