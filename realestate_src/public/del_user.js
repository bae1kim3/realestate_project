var confirmBtn = document.getElementById("confirmBtn");

const withdrawal = function() {
    confirmBtn.addEventListener("click", function() {
            let form = document.getElementById("deleteForm");
            form.submit();
    });

}
