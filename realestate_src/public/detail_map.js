let sLong = document.getElementById('s_log');
let sLat = document.getElementById('s_lat');
let sName = document.getElementById('s_name');
let getShop = document.getElementById('getshop');
let getHosp = document.getElementById('gethosp');
let getWalk = document.getElementById('getwalk');
let imageSize = new kakao.maps.Size(35, 35); // 마커이미지의 크기입니다의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
let shopMarkers = [];
let hospMarkers = [];
let walkMarkers = [];


// 지도, 건물 마커 표시
    var container = document.getElementById('map');
    var options = {
        center: new kakao.maps.LatLng(sLong.value, sLat.value),
        level: 7
    };

    // 지도 생성
    var map = new kakao.maps.Map(container, options);

    var position = new kakao.maps.LatLng(sLong.value, sLat.value); // 마커가 표시될 위치를 설정합니다
    var iwContent = '<div style= "padding:5px; padding-left:45px; font-weight:900;">'+ sName.value +'</div>'; // 인포윈도우에 표시될 내용입니다
    // var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize) // 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
    
    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        map: map,
        position: position,
        // image: markerImage
    });

    // 인포윈도우를 생성합니다
    var infowindow = new kakao.maps.InfoWindow({
        content: iwContent
    });
    // 인포윈도우를 마커 위에 표시합니다
    infowindow.open(map, marker);


//api 버튼 클릭시 마커 표시
getWalk.addEventListener("click", function() {
    if(walkMarkers.length == 0) {
        let pageNo = 0;
        let numOfRows = 20;
        let servicekey = "NK9bUcQ3fL1MAEyB8pXRvs9h%2FkslsZCDyjyb6ri5duPH%2F1e%2Bq%2F9gBYZEpaykEKq%2B25C8huHvBFK1PNQKjlK8%2Bw%3D%3D"
        let url = "https://apis.data.go.kr/6270000/dgInParkwalk/getDgWalkParkList?serviceKey=" + servicekey+ 
                    "&pageNo=" + pageNo +
                    "&numOfRows="+ numOfRows +
                    "&type=json&lat=" + sLong.value +
                    "&lot=" + sLat.value +
                    "&radius=5";
        
        fetch(url)
        .then((response) => response.json())
        .then((data) => {
            let getdata = data.body.items.item;
            var imageSrc = 'https://cdn-icons-png.flaticon.com/128/464/464954.png';
            markerImage = new kakao.maps.MarkerImage(
                imageSrc,
                imageSize
                );
                
                for (let i = 0; i < getdata.length; i++) {
                    let markerPosition = new kakao.maps.LatLng(
                        getdata[i].lat,
                        getdata[i].lot
                        );
                        
                        marker = new kakao.maps.Marker({
                            position: markerPosition,
                            image: markerImage,
                        });
                        // console.log(data);
                marker.setZIndex(-2);
                marker.setMap(map);
                // 생성된 마커를 배열에 추가합니다
                walkMarkers.push(marker);
            }
        })
        .catch(() => {console.log('error')})
    } else {
        for (var i = 0; i < walkMarkers.length; i++) {
            walkMarkers[i].setMap(null);
        }
        walkMarkers = [];
    }

});

// 동물 상점 마커
getShop.addEventListener("click", function() {
    if(shopMarkers.length == 0) {
        let page = 1;
        let size = 10;
        const REST_API_KEY = 'dae00046c1734639efa0941b96eb225b';
        const url = "https://dapi.kakao.com/v2/local/search/keyword.json?"+ 
                    "page=" + page +
                    "&size="+ size +
                    "&sort=distance&query=반려동물용품점&x=" + sLat.value +
                    "&y=" + sLong.value +
                    "&radius=5000";
        const options = {
            method: 'GET',
            headers: {
                'Authorization': `KakaoAK ${REST_API_KEY}`
            }
            };
        fetch(url, options)
        .then((response) => response.json())
        .then((data) => {
            let getdata = data.documents;
            var imageSrc = 'https://cdn-icons-png.flaticon.com/128/10714/10714015.png';
            
            markerImage = new kakao.maps.MarkerImage(
                imageSrc,
                imageSize
                );
                
                for (let i = 0; i < getdata.length; i++) {
                    let markerPosition = new kakao.maps.LatLng(
                        getdata[i].y,
                        getdata[i].x
                        );
                        
                        marker = new kakao.maps.Marker({
                            position: markerPosition,
                            image: markerImage,
                        });
                        // console.log(data);
                marker.setZIndex(-2);
                marker.setMap(map);
                // 생성된 마커를 배열에 추가합니다
                shopMarkers.push(marker);
            }
        })
        .catch(() => {console.log('error')})
    } else {
        for (var i = 0; i < shopMarkers.length; i++) {
            shopMarkers[i].setMap(null);
        }
        shopMarkers = [];
    }

});

// 동물병원 마커
getHosp.addEventListener("click", function() {
    if(hospMarkers.length == 0) {
        let page = 1;
        let size = 10;
        const REST_API_KEY = 'dae00046c1734639efa0941b96eb225b';
        const url = "https://dapi.kakao.com/v2/local/search/keyword.json?"+ 
                    "page=" + page +
                    "&size="+ size +
                    "&sort=distance&query=동물병원&x=" + sLat.value +
                    "&y=" + sLong.value +
                    "&radius=5000";
        const options = {
            method: 'GET',
            headers: {
                'Authorization': `KakaoAK ${REST_API_KEY}`
            }
            };
        fetch(url, options)
        .then((response) => response.json())
        .then((data) => {

            let getdata = data.documents;
            var imageSrc = 'https://cdn-icons-png.flaticon.com/128/10887/10887257.png';
            
            markerImage = new kakao.maps.MarkerImage(
                imageSrc,
                imageSize
                );
                
                for (let i = 0; i < getdata.length; i++) {
                    let markerPosition = new kakao.maps.LatLng(
                        getdata[i].y,
                        getdata[i].x
                        );
                        
                        marker = new kakao.maps.Marker({
                            position: markerPosition,
                            image: markerImage,
                        });
                        // console.log(data);
                marker.setZIndex(-2);
                marker.setMap(map);
                // 생성된 마커를 배열에 추가합니다
                hospMarkers.push(marker);
            }
        })
        .catch(() => {console.log('error')})
    } else {
        for (var i = 0; i < hospMarkers.length; i++) {
            hospMarkers[i].setMap(null);
        }
        hospMarkers = [];
    }

});




