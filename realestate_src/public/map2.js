const selectBox = document.getElementById("option");
const mapContainer = document.getElementById("map");
const checkboxes = document.querySelectorAll(
    '.dropdown-menu input[class="opt"]'
);
const scheckboxes = document.querySelectorAll(
    '.dropdown-menu input[class="sopt"]'
);
const sshpaecheckboxes = document.querySelectorAll(
    '.dropdown-menu input[class="sshape"]'
);
const getpark = document.getElementById("getpark");
let getShop = document.getElementById('getshop');
let getHosp = document.getElementById('gethosp');
const container = document.getElementById("sidebar");
let selectedMarker = null;
let cardId;
let selectValues = [];
let soptionValues = [];
let sshpadeValues = [];
let level = 8;
// 지도에 표시된 마커 객체를 가지고 있을 배열입니다
let markers = [];
let pmarkers = [];
let map;
let marker;
let iwContent = [];
let infowindow = [];
let markerImage;
let imageSrc = "maphome.png";
let imageSize = new kakao.maps.Size(24, 30);
let clickimageSize = new kakao.maps.Size(35, 45);
let pageno = 0;
let numofrows = 0;
let radius = "";
let clickmarkerImage;
let selectedCard = 0;
let num = 0;
let shopMarkers = [];
let hospMarkers = [];
let walkMarkers = [];
let sName = document.getElementById('s_name');
let defaultlng = '';
let defaultlat = '';

function addlist(data, i) {
    iwContent[
        i
    ] = `<div style="padding:4px"><b>${data["sinfo"][i].s_name}</b>(${data["sinfo"][i].s_type})</div>`; // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
    // 인포윈도우를 생성합니다
    infowindow[i] = new kakao.maps.InfoWindow({
        content: iwContent[i],
    });
    kakao.maps.event.addListener(markers[i], "click", function () {
        // 마커 클릭 시 URL로 이동
        window.location.href = `#${markers[i].id}`;
        cardId = document.getElementById(markers[i].id);
        if (selectedCard == 0) {
            document.getElementById(markers[i].id).classList.add("selected");
            selectedCard = markers[i].id;
        } else if (selectedCard != markers[i].id) {
            document.getElementById(selectedCard).classList.remove("selected");
            selectedCard = 0;
            document.getElementById(markers[i].id).classList.add("selected");
            selectedCard = markers[i].id;
        }

        clickmarkerImage = new kakao.maps.MarkerImage(imageSrc, clickimageSize);
        if (!selectedMarker || selectedMarker !== markers[i]) {
            // 클릭된 마커 객체가 null이 아니면
            // 클릭된 마커의 이미지를 기본 이미지로 변경하고
            !!selectedMarker && selectedMarker.setImage(markerImage);

            // 현재 클릭된 마커의 이미지는 클릭 이미지로 변경합니다
            markers[i].setImage(clickmarkerImage);
        }

        // 클릭된 마커를 현재 클릭된 마커 객체로 설정합니다
        selectedMarker = markers[i];
    });
    kakao.maps.event.addListener(markers[i], "mouseover", function () {
        // 마커에 마우스오버 이벤트가 발생하면 인포윈도우를 마커위에 표시합니다
        infowindow[i].open(map, markers[i]);
    });
    // 마커에 마우스아웃 이벤트를 등록합니다
    kakao.maps.event.addListener(markers[i], "mouseout", function () {
        // 마커에 마우스아웃 이벤트가 발생하면 인포윈도우를 제거합니다
        infowindow[i].close();
    });
}
// 마커를 생성하고 지도위에 표시하는 함수입니다
function addMarker(position, data, i) {
    // 마커를 생성합니다
    marker = new kakao.maps.Marker({
        position: position,
        image: markerImage,
    });
    marker.id = data["sinfo"][i].s_no;
    // 마커가 지도 위에 표시되도록 설정합니다
    marker.setMap(map);

    // 생성된 마커를 배열에 추가합니다
    markers.push(marker);
}

function setMarkers() {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
}

function addfetch(url, selectedOption) {
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            mapOption = {
                center: new kakao.maps.LatLng(
                    data["latlng"].lat,
                    data["latlng"].lng
                ), // 지도의 중심좌표
                level: level, // 지도의 확대 레벨
            };
            markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);
            map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다


            // 0717 김민규 지도에 확대, 거리 로드뷰 추가
            var mapTypeControl = new kakao.maps.MapTypeControl();
            map.addControl(mapTypeControl, kakao.maps.ControlPosition.BOTTOMRIGHT);


            let smothb = 0;
            for (let i = 0; i < data["monthly"].length; i++) {
                smothb += data["monthly"][i].p_deposit;
            }
            let mtsavg = smothb / data["monthly"].length;
            let monthbavg = Math.ceil(isNaN(mtsavg) ? "0" : mtsavg);

            let smothm = 0;
            for (let i = 0; i < data["monthly"].length; i++) {
                smothm += data["monthly"][i].p_month;
            }
            let mtmsavg = smothm / data["monthly"].length;
            let monthmavg = Math.ceil(isNaN(mtmsavg) ? "0" : mtmsavg);

            let jeonsep = 0;
            for (let i = 0; i < data["jeonse"].length; i++) {
                jeonsep += data["jeonse"][i].p_deposit;
            }
            let jeonsavg = jeonsep / data["jeonse"].length;
            let jeonpavg = Math.ceil(isNaN(jeonsavg) ? "0" : jeonsavg);

            let trade = 0;
            for (let i = 0; i < data["trade"].length; i++) {
                trade += data["trade"][i].p_deposit;
            }
            let tradeavg = trade / data["trade"].length;
            let tradepavg = Math.ceil(isNaN(tradeavg) ? "0" : tradeavg);

            container.innerText = "";
            // 부모 요소 생성
            var accordion = document.createElement("div");
            accordion.className = "accordion";
            accordion.id = "accordionExample";

            // 아코디언 아이템 생성
            var accordionItem = document.createElement("div");
            accordionItem.className = "accordion-item";

            // 아코디언 헤더 생성
            var accordionHeader = document.createElement("h2");
            accordionHeader.className = "accordion-header";
            accordionHeader.id = "headingOne";

            // 아코디언 버튼 생성
            var accordionButton = document.createElement("button");
            accordionButton.className = "accordion-button collapsed";
            accordionButton.type = "button";
            accordionButton.setAttribute("data-bs-toggle", "collapse");
            accordionButton.setAttribute("data-bs-target", "#collapseOne");
            accordionButton.setAttribute("aria-expanded", "true");
            accordionButton.setAttribute("aria-controls", "collapseOne");
            accordionButton.innerHTML = `<strong><span>${selectedOption == "구 선택" ? "전체 구" : selectedOption
                }의 평균가</span></strong>`;

            // 아코디언 컨텐츠 생성
            var accordionCollapse = document.createElement("div");
            accordionCollapse.id = "collapseOne";
            accordionCollapse.className = "accordion-collapse collapse";
            accordionCollapse.setAttribute("aria-labelledby", "headingOne");
            accordionCollapse.setAttribute(
                "data-bs-parent",
                "#accordionExample"
            );

            var accordionBody = document.createElement("div");
            accordionBody.className = "accordion-body";
            accordionBody.innerHTML = `<b>보증금/월세</b><br> ${monthbavg.toLocaleString(
                "ko-KR"
            )}/${monthmavg.toLocaleString(
                "ko-KR"
            )}만원 <br> <b>전세</b><br> ${jeonpavg.toLocaleString(
                "ko-KR"
            )}만원 <br> <b>매매</b><br> ${tradepavg.toLocaleString(
                "ko-KR"
            )}만원`;

            // 요소들을 구조에 맞게 추가
            accordionHeader.appendChild(accordionButton);
            accordionCollapse.appendChild(accordionBody);
            accordionItem.appendChild(accordionHeader);
            accordionItem.appendChild(accordionCollapse);
            accordion.appendChild(accordionItem);

            // 최종적으로 생성된 구조를 원하는 위치에 추가
            container.appendChild(accordion);
            for (let i = 0; i < data["sinfo"].length; i++) {
                // 카드 요소 생성
                let atag = document.createElement("a");
                atag.setAttribute(
                    "href",
                    `http://192.168.0.129/sDetail/${data["sinfo"][i].s_no}`
                );
                atag.setAttribute("target", `_blank`);
                var card = document.createElement("div");
                card.style.border = "3px solid black";
                card.id = `${data["sinfo"][i].s_no}`;
                card.classList.add("card");
                card.style.width = "18rem";

                // 이미지 요소 생성
                var image = document.createElement("img");
                image.src = data["sinfo"][i].url; // 이미지 소스를 설정해주세요
                image.style.height = "200px";
                image.className = "card-img-top";
                image.alt = "메인이미지"; // 대체 텍스트를 설정해주세요

                // 카드 바디 요소 생성
                var cardBody = document.createElement("div");
                cardBody.className = "card-body";

                // 카드 내용 생성
                var cardText = document.createElement("p");
                cardText.className = "card-text";

                // s_option 번호로 되어있는거 텍스트로 변환
                switch (data["sinfo"][i].s_option) {
                    case "0":
                        data["sinfo"][i].s_option = "아파트";
                        break;
                    case "1":
                        data["sinfo"][i].s_option = "단독주택";
                        break;
                    case "2":
                        data["sinfo"][i].s_option = "오피스텔";
                        break;
                    case "3":
                        data["sinfo"][i].s_option = "빌라";
                        break;
                    case "4":
                        data["sinfo"][i].s_option = "원룸";
                        break;
                    default:
                        break;
                }
                if (data["sinfo"][i].s_type == "월세") {
                    cardText.innerHTML =
                        "<b>건물유형</b> : "
                        + data["sinfo"][i].s_option
                        + "<br>"
                        + "<b>매매유형</b> : "
                        + data["sinfo"][i].s_type
                        + "<br><b>가격</b> : "
                        + data["sinfo"][i].p_deposit.toLocaleString("ko-KR")
                        + "만원 / "
                        + data["sinfo"][i].p_month.toLocaleString("ko-KR")
                        + "만원<br><b>층수</b> : "
                        + data["sinfo"][i].s_fl
                        + " <b>층</b><br><b>평수</b> : "
                        + data["sinfo"][i].s_size
                        + " <b>평</b><br><b>주소</b> : "
                        + data["sinfo"][i].s_add;
                } else {
                    cardText.innerHTML =
                        "<b>매매유형</b> : "
                        + data["sinfo"][i].s_type
                        + "<br><b>가격</b> : "
                        + data["sinfo"][i].p_deposit.toLocaleString("ko-KR")
                        + "만원<br><b>층수</b> : "
                        + data["sinfo"][i].s_fl
                        + " <b>층</b><br><b>평수</b> : "
                        + data["sinfo"][i].s_size
                        + " <b>평</b><br><b>주소</b> : "
                        + data["sinfo"][i].s_add;
                }

                // 요소들을 조합하여 구조 생성
                cardBody.appendChild(cardText);
                card.appendChild(image);
                card.appendChild(cardBody);
                atag.appendChild(card);
                // 생성한 카드를 원하는 위치에 추가
                container.appendChild(atag);
            }
            selectedCard = 0;
            markers = [];
            for (let i = 0; i < data["sinfo"].length; i++) {
                // 마커 하나를 지도위에 표시합니다
                addMarker(
                    new kakao.maps.LatLng(
                        data["sinfo"][i].s_log,
                        data["sinfo"][i].s_lat
                    ),
                    data,
                    i
                );
                addlist(data, i);
            }
        });
}

// 처음 윈도우를 로드 했을 때 실행되는
document.addEventListener("DOMContentLoaded", function () {
    var selectedOption = selectBox.value;
    let url =
        "http://192.168.0.129/api/mapopt/" +
        (selectValues.length ? selectValues.join(",") : "1") +
        "/" +
        selectedOption +
        "/" +
        (soptionValues.length ? soptionValues.join(",") : "1") +
        "/" +
        (sshpadeValues.length ? sshpadeValues.join(",") : "1");
    addfetch(url, selectedOption);
});

selectBox.addEventListener("change", function () {
    var selectedOption = selectBox.value;
    let url =
        "http://192.168.0.129/api/mapopt/" +
        (selectValues.length ? selectValues.join(",") : "1") +
        "/" +
        selectedOption +
        "/" +
        (soptionValues.length ? soptionValues.join(",") : "1") +
        "/" +
        (sshpadeValues.length ? sshpadeValues.join(",") : "1");
    addfetch(url, selectedOption);
});

// 드롭다운 토글 버튼 클릭 이벤트 처리
document.addEventListener("click", function (event) {
    const dropdownToggle = event.target.closest(".dropdown-toggle");
    if (dropdownToggle) {
        const dropdownMenu = dropdownToggle.nextElementSibling;
        dropdownMenu.classList.toggle("open");
    }
});
document.addEventListener("click", function (event) {
    const dropdownToggle = event.target.closest(".dropdown-toggle1");
    if (dropdownToggle) {
        const dropdownMenu = dropdownToggle.nextElementSibling;
        dropdownMenu.classList.toggle("open1");
    }
});

// 거래 유형 
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        var selectedOption = selectBox.value;
        let value = checkbox.value;
        if (checkbox.checked) {
            selectValues.push(value);
        } else {
            let index = selectValues.indexOf(value);
            if (index !== -1) {
                selectValues.splice(index, 1);
            }
        }
        let url =
            "http://192.168.0.129/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1") +
            "/" +
            (sshpadeValues.length ? sshpadeValues.join(",") : "1");
        addfetch(url, selectedOption);
    });
});

scheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        var selectedOption = selectBox.value;
        let value = checkbox.value;
        if (checkbox.checked) {
            soptionValues.push(value);
        } else {
            let index = soptionValues.indexOf(value);
            if (index !== -1) {
                soptionValues.splice(index, 1);
            }
        }
        let url =
            "http://192.168.0.129/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1") +
            "/" +
            (sshpadeValues.length ? sshpadeValues.join(",") : "1");
        addfetch(url, selectedOption);
    });
});

sshpaecheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        var selectedOption = selectBox.value;
        let value = checkbox.value;
        if (checkbox.checked) {
            sshpadeValues.push(value);
        } else {
            let index = sshpadeValues.indexOf(value);
            if (index !== -1) {
                sshpadeValues.splice(index, 1);
            }
        }
        let url =
            "http://192.168.0.129/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1") +
            "/" +
            (sshpadeValues.length ? sshpadeValues.join(",") : "1");
        addfetch(url, selectedOption);
    });
});

getpark.addEventListener("click", function (checkbox) {
    if (pmarkers.length == 0) {
        var selectedOption = selectBox.value;
        let value = checkbox.value;
        if (checkbox.checked) {
            selectValues.push(value);
        } else {
            let index = selectValues.indexOf(value);
            if (index !== -1) {
                selectValues.splice(index, 1);
            }
        }
        let url =
            "http://192.168.0.129/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1") +
            "/" +
            (sshpadeValues.length ? sshpadeValues.join(",") : "1");
        // AJAX 요청 보내기
        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                const servicekey =
                    "cHVjVjglbOBfaJaLkhiSbBrRU2U3MkuefQS0rxexSVZcSA8vF6zeNrhf7LmjNlJGibN%2BM%2BPpK9GGjbmpsfD7FA%3D%3D";
                if (selectedOption == "구 선택") {
                    pageno = 0;
                    numofrows = 20;
                    radius = "4";
                } else {
                    pageno = 0;
                    numofrows = 10;
                    radius = "3";
                }

                const url =
                    "https://apis.data.go.kr/6270000/dgInParkwalk/getDgWalkParkList?serviceKey=" +
                    servicekey +
                    "&pageNo=" +
                    pageno +
                    "&numOfRows=" +
                    numofrows +
                    "&type=json&lat=" +
                    data["latlng"].lat +
                    "&lot=" +
                    data["latlng"].lng +
                    "&radius=" +
                    radius;
                fetch(url)
                    .then((response) => response.json())
                    .then((data1) => {
                        console.log(data1);
                        let getdata = data1.body.items.item;
                        console.log(getdata);
                        var imageSrcPark = "mapp.png";
                        markerImage = new kakao.maps.MarkerImage(
                            imageSrcPark,
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
                            marker.setZIndex(-2);
                            marker.setMap(map);
                            // 생성된 마커를 배열에 추가합니다
                            pmarkers.push(marker);
                        }
                        // 공원 마커찍고 기본 마커 이미지로 초기화
                        markerImage = new kakao.maps.MarkerImage(
                            imageSrc,
                            imageSize
                        );
                    });
            });
    } else {
        for (var i = 0; i < pmarkers.length; i++) {
            pmarkers[i].setMap(null);
        }
        pmarkers = [];
    }
    getpark.classList.toggle("selectedpark");
});

//api 버튼 클릭시 마커 표시

// 반려동물 용품점 마커
getShop.addEventListener("click", function (checkbox) {
    // 동물용품점 마커가 찍혀있지 않으면 작동 찍혀있으면 사라짐
    if (shopMarkers.length == 0) {
        var selectedOption = selectBox.value;
        let value = checkbox.value;
        if (checkbox.checked) {
            selectValues.push(value);
        } else {
            let index = selectValues.indexOf(value);
            if (index !== -1) {
                selectValues.splice(index, 1);
            }
        }
        let url =
            "http://192.168.0.129/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1") +
            "/" +
            (sshpadeValues.length ? sshpadeValues.join(",") : "1");
        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                // 지금 설정한 구,군에 따라 기준좌표 설정
                defaultlat = data.latlng.lat;
                defaultlng = data.latlng.lng;

                let page = 1;
                let size = 15;
                const url = "https://dapi.kakao.com/v2/local/search/keyword.json?" +
                    "page=" + page +
                    "&size=" + size +
                    "&sort=distance&query=반려동물용품점&x=" + defaultlng +
                    "&y=" + defaultlat +
                    "&radius=5000";

                const REST_API_KEY = 'dae00046c1734639efa0941b96eb225b';
                const options = {
                    method: 'GET',
                    headers: {
                        'Authorization': `KakaoAK ${REST_API_KEY}`
                    }
                };
                fetch(url, options)
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data);
                        let getdata = data.documents;
                        var imageSrcShop = 'https://cdn-icons-png.flaticon.com/128/2447/2447823.png';

                        markerImage = new kakao.maps.MarkerImage(
                            imageSrcShop,
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
                            marker.setZIndex(-2);
                            marker.setMap(map);
                            // 생성된 마커를 배열에 추가합니다
                            shopMarkers.push(marker);
                        }
                        // 상점 마커찍고 기본 마커 이미지로 초기화
                        markerImage = new kakao.maps.MarkerImage(
                            imageSrc,
                            imageSize
                        );
                    })
            })
            .catch(() => {
                console.log('error');
            });
    } else {
        for (var i = 0; i < shopMarkers.length; i++) {
            shopMarkers[i].setMap(null);
        }
        shopMarkers = [];
    }
});

// 동물병원 마커
getHosp.addEventListener("click", function (checkbox) {
    // 동물용품점 마커가 찍혀있지 않으면 작동 찍혀있으면 사라짐
    if (hospMarkers.length == 0) {
        var selectedOption = selectBox.value;
        let value = checkbox.value;
        if (checkbox.checked) {
            selectValues.push(value);
        } else {
            let index = selectValues.indexOf(value);
            if (index !== -1) {
                selectValues.splice(index, 1);
            }
        }
        let url =
            "http://192.168.0.129/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1") +
            "/" +
            (sshpadeValues.length ? sshpadeValues.join(",") : "1");
        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                // 지금 설정한 구,군에 따라 기준좌표 설정
                defaultlat = data.latlng.lat;
                defaultlng = data.latlng.lng;
                let page = 1;
                let size = 15;
                const url = "https://dapi.kakao.com/v2/local/search/keyword.json?" +
                    "page=" + page +
                    "&size=" + size +
                    "&sort=distance&query=동물병원&x=" + defaultlng +
                    "&y=" + defaultlat +
                    "&radius=5000";
                const REST_API_KEY = 'dae00046c1734639efa0941b96eb225b';
                const options = {
                    method: 'GET',
                    headers: {
                        'Authorization': `KakaoAK ${REST_API_KEY}`
                    }
                };
                fetch(url, options)
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data);
                        let getdata = data.documents;
                        var imageSrcHosp = 'https://cdn-icons-png.flaticon.com/128/10887/10887257.png';

                        markerImage = new kakao.maps.MarkerImage(
                            imageSrcHosp,
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
                            marker.setZIndex(-2);
                            marker.setMap(map);
                            // 생성된 마커를 배열에 추가합니다
                            hospMarkers.push(marker);
                        }
                        // 병원 마커찍고 기본 마커 이미지로 초기화
                        markerImage = new kakao.maps.MarkerImage(
                            imageSrc,
                            imageSize
                        );
                    })
            })
            .catch(() => {
                console.log('error');
            });
    } else {
        for (var i = 0; i < hospMarkers.length; i++) {
            hospMarkers[i].setMap(null);
        }
        hospMarkers = [];
    }
});