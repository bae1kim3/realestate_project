var geocoder = new kakao.maps.services.Geocoder();

const submit_btn = document.getElementById('submit_btn');

submit_btn.addEventListener('click', () => {
    var val = document.getElementById('sample6_address').value;
    var s_log = document.getElementById('s_log');
    var s_lat = document.getElementById('s_lat');
    if(!val) {
        window.scrollTo(0,0);
        $err = document.getElementById('err_up').innerHTML = "정보를 입력하세요";
        err_up.style.display = 'block';
        return;
    }

    var callback = function(result, status) {
        if (status === kakao.maps.services.Status.OK) {
            // console.log(result);
            // console.log(result[0]['x']);
            // console.log(result[0]['y']);
            s_lat.value = result[0]['x'];
            s_log.value = result[0]['y'];

            document.getElementById('frm').submit();
        }
    };
    geocoder.addressSearch(val, callback);
});



