let newWindow = null;
btn2.addEventListener("click", () => {
    newWindow = open("", "test", "width=500 height=500");
});

// 팝업 창 닫기
const btn3 = document.getElementById("btn3");
btn3.addEventListener("click", () => {
    newWindow.close();
});
