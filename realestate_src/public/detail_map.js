let sLong = document.getElementById('s_log');
let sLat = document.getElementById('s_lat');
let sName = document.getElementById('s_name');
let getShop = document.getElementById('getshop');
let getHosp = document.getElementById('gethosp');
let getWalk = document.getElementById('getwalk');
let imageSize = new kakao.maps.Size(40, 40); // 마커이미지의 크기입니다의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
let pmarkers = [];
// let imageSrc = "mapp.png";

// 지도, 건물 마커 표시
    var container = document.getElementById('map');
    var options = {
        center: new kakao.maps.LatLng(sLong.value, sLat.value),
        level: 6
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

// function multiImgMarker () {

//     // 마커를 표시할 위치와 title 객체 배열입니다 
//     var positions = [
//         {
//             title: '카카오', 
//             latlng: new kakao.maps.LatLng(33.450705, 126.570677)
//         },
//         {
//             title: '생태연못', 
//             latlng: new kakao.maps.LatLng(33.450936, 126.569477)
//         },
//         {
//             title: '텃밭', 
//             latlng: new kakao.maps.LatLng(33.450879, 126.569940)
//         },
//         {
//             title: '근린공원',
//             latlng: new kakao.maps.LatLng(33.451393, 126.570738)
//         }
//     ];
//     // 마커 이미지의 이미지 주소입니다
//     var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 
        
//     for (var i = 0; i < positions.length; i ++) {
        
//         // 마커 이미지의 이미지 크기 입니다
//         var imageSize = new kakao.maps.Size(24, 35); 
        
//         // 마커 이미지를 생성합니다    
//         var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
        
//         // 마커를 생성합니다
//         var marker = new kakao.maps.Marker({
//             map: map, // 마커를 표시할 지도
//             position: positions[i].latlng, // 마커를 표시할 위치
//             title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
//             image : markerImage // 마커 이미지 
//         });
//     }
// }

//api 버튼 클릭시 마커 표시
getWalk.addEventListener("click", function() {
    if(pmarkers.length == 0) {
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
                pmarkers.push(marker);
            }
        })
        .catch(() => {console.log('error')})
    } else {
        for (var i = 0; i < pmarkers.length; i++) {
            pmarkers[i].setMap(null);
        }
        pmarkers = [];
    }
    


});


