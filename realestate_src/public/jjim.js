let sNo = document.getElementById('s_no');
let id = document.getElementById('id');
let likedFlg = document.getElementById('likedFlg');
let empHeart = document.getElementById('emp_heart');
let fullHeart = document.getElementById('full_heart');
let postUrl = '/api/liked/post/' + sNo.value;
let delUrl = '/api/liked/delete/' + sNo.value;

if(likedFlg.value == 0) {
    fullHeart.classList.add('none');
    empHeart.classList.remove('none');
}
else {
    empHeart.classList.add('none');
    fullHeart.classList.remove('none');
}

function storeLiked () {
    fetch(postUrl, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            // "X-CSRF-TOKEN": token
            },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
            id: id.value,
            s_no: sNo.value,
        })
    }) // 여기까지 실행되고 backend로 넘어감
    .then(data=>{
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
    .then((apiData) => { // return 된 data.json()값 = apiData
        console.log(apiData);
        if(apiData['errorcode'] === 'E01'){
            // return console.log(apiData['msg']);
            return window.location.href = 'http://127.0.0.1:8000/login';
        }

        fullHeart.classList.remove('none');
        empHeart.classList.add('none');
    })
    .catch(function(error) {
        console.log('실패'+error);
    });
};

function deleteLiked() {
    fetch(delUrl, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            // "X-CSRF-TOKEN": token
            },
        method: 'delete',
        body: JSON.stringify({
            id: id.value,
            s_no: sNo.value,
            liked_flg: likedFlg.value
        })
    })
    .then(data=>{
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
    .then((apiData) => {
        console.log(apiData);
        if(apiData['errorcode'] === 'E01'){
            // return console.log(apiData['msg']);
            return window.location.href = 'http://www.localhost/login';
        }
        fullHeart.classList.add('none');
        empHeart.classList.remove('none');
    })
    .catch(function(error) {
        console.log('실패'+error);
    });
}
