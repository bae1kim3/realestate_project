const tabs = document.querySelectorAll("[data-tab-target]");
const tabcon = document.querySelectorAll("[data-tab-content");
tabs.forEach((tab)=> {
    tab.addEventListener("click", ()=>{
        const target = document.querySelector(tab.dataset.tabTarget);

        if (tab.dataset.tabTarget === "#tab2") {
            document.getElementById("pw_ch").style.display = "none";
            document.getElementById("user_del").style.display = "none";
        }else {
            // 다른 탭을 클릭했을 때는 "pw_ch"와 "user_del" 요소를 보이게 처리
            document.getElementById("pw_ch").style.display = "block";
            document.getElementById("user_del").style.display = "block";
        }
        
        tabcon.forEach((tabc_all)=> {
            tabc_all.classList.remove("active");
        });

        target.classList.add("active");
    });
});

