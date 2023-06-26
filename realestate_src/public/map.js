var selectBox = document.getElementById("option");
var mapContainer = document.getElementById("map"); // 지도를 표시할 div
let checkboxes = document.querySelectorAll('.dropdown-menu input[id="opt"]');
let scheckboxes = document.querySelectorAll('.dropdown-menu input[id="sopt"]');
let selectValues = [];
let soptionValues = [];
let level = 8;
// 지도에 표시된 마커 객체를 가지고 있을 배열입니다
let markers = [];
let pmarkers = [];
let map;
let marker;
var iwContent = [];
var infowindow = [];
var markerImage;
var imageSrc = "maphome.png";
var imageSize = new kakao.maps.Size(24, 35);

// 마커를 생성하고 지도위에 표시하는 함수입니다
function addMarker(position) {
    // 마커를 생성합니다
    marker = new kakao.maps.Marker({
        position: position,
        image: markerImage,
    });

    // 마커가 지도 위에 표시되도록 설정합니다
    marker.setMap(map);

    // 생성된 마커를 배열에 추가합니다
    markers.push(marker);
}

function setMarkers() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
}

// 처음 윈도우를 로드 했을 때 실행되는
document.addEventListener("DOMContentLoaded", function (/* checkbox */) {
    var selectedOption = selectBox.value;
    const elements = document.getElementsByTagName("p");
    for (let i = 0; i < elements.length; i++) {
        if (elements[i].textContent.includes("")) {
            // 원하는 동작 수행
            console.log("특정 텍스트가 일치하는 요소:", elements[i]);
        }
    }
    // let value = checkbox.value;
    // if (checkbox.checked) {
    //     selectValues.push(value);
    // } else {
    //     let index = selectValues.indexOf(value);
    //     if (index !== -1) {
    //         selectValues.splice(index, 1);
    //     }
    // }
    // console.log(checkbox);
    let url =
        "http://127.0.0.1:8000/api/mapopt/" +
        (selectValues.length ? selectValues.join(",") : "1") +
        "/" +
        selectedOption +
        "/" +
        (soptionValues.length ? soptionValues.join(",") : "1");
    console.log(url);
    console.log(selectValues);
    console.log(selectedOption);
    // AJAX 요청 보내기

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // var mapContainer = document.getElementById('map'), // 지도를 표시할 div
            mapOption = {
                center: new kakao.maps.LatLng(
                    data["latlng"].lat,
                    data["latlng"].lng
                ), // 지도의 중심좌표
                level: level, // 지도의 확대 레벨
            };

            markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);
            map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

            for (let i = 0; i < data["sinfo"].length; i++) {
                // 마커 하나를 지도위에 표시합니다
                addMarker(
                    new kakao.maps.LatLng(
                        data["sinfo"][i].s_log,
                        data["sinfo"][i].s_lat
                    )
                );
                // 마커에 커서가 오버됐을 때 마커 위에 표시할 인포윈도우를 생성합니다
                iwContent[
                    i
                ] = `<div style="padding:5px;"><b>${data["sinfo"][i].s_name}</b>(${data["sinfo"][i].s_type})</div>`; // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다

                // 인포윈도우를 생성합니다
                infowindow[i] = new kakao.maps.InfoWindow({
                    content: iwContent[i],
                });

                kakao.maps.event.addListener(marker, "click", function () {
                    alert("marker click!");
                });

                kakao.maps.event.addListener(
                    markers[i],
                    "mouseover",
                    function () {
                        // 마커에 마우스오버 이벤트가 발생하면 인포윈도우를 마커위에 표시합니다
                        infowindow[i].open(map, markers[i]);
                    }
                );

                // 마커에 마우스아웃 이벤트를 등록합니다
                kakao.maps.event.addListener(
                    markers[i],
                    "mouseout",
                    function () {
                        // 마커에 마우스아웃 이벤트가 발생하면 인포윈도우를 제거합니다
                        infowindow[i].close();
                    }
                );
            }

            let ssum = 0;
            for (let i = 0; i < data["savg"].length - 1; i++) {
                ssum += data["savg"][i].p_deposit;
            }
            let savg1 = ssum / data["savg"].length;
            let savg = isNaN(savg1) ? "0" : savg1;
            console.log(savg);
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
            accordionButton.textContent = `${
                selectedOption == "구 선택" ? "전체 구" : selectedOption
            }의평균매매가`;

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
            accordionBody.innerHTML = `${
                selectedOption == "구 선택" ? "전체 구" : selectedOption
            }의 평균 : ${savg.toLocaleString("ko-KR")}만원`;

            // 요소들을 구조에 맞게 추가
            accordionHeader.appendChild(accordionButton);
            accordionCollapse.appendChild(accordionBody);
            accordionItem.appendChild(accordionHeader);
            accordionItem.appendChild(accordionCollapse);
            accordion.appendChild(accordionItem);

            // 최종적으로 생성된 구조를 원하는 위치에 추가
            var container = document.getElementById("sidebar"); // 적절한 컨테이너 요소 선택
            container.appendChild(accordion);
            for (let i = 0; i < data["sinfo"].length; i++) {
                // 카드 요소 생성
                var card = document.createElement("div");
                card.className = "card";
                card.style.width = "18rem";

                // 이미지 요소 생성
                var image = document.createElement("img");
                image.src = data["sinfo"][i].url; // 이미지 소스를 설정해주세요
                image.className = "card-img-top";
                image.alt = "메인이미지"; // 대체 텍스트를 설정해주세요

                // 카드 바디 요소 생성
                var cardBody = document.createElement("div");
                cardBody.className = "card-body";

                // 카드 내용 생성
                var cardText = document.createElement("p");
                cardText.className = "card-text";
                cardText.innerHTML =
                    "매매유형 : " +
                    data["sinfo"][i].s_type +
                    "<br>주소 : " +
                    data["sinfo"][i].s_add;

                // 요소들을 조합하여 구조 생성
                cardBody.appendChild(cardText);
                card.appendChild(image);
                card.appendChild(cardBody);

                // 생성한 카드를 원하는 위치에 추가
                var container = document.getElementById("sidebar"); // 카드를 추가할 컨테이너 요소를 선택해주세요
                container.appendChild(card);
            }
        });
});

selectBox.addEventListener("change", function (/* checkbox */) {
    var selectedOption = selectBox.value;
    // let value = checkbox.value;
    // if (checkbox.checked) {
    //     selectValues.push(value);
    // } else {
    //     let index = selectValues.indexOf(value);
    //     if (index !== -1) {
    //         selectValues.splice(index, 1);
    //     }
    // }
    // console.log(value);
    let url =
        "http://127.0.0.1:8000/api/mapopt/" +
        (selectValues.length ? selectValues.join(",") : "1") +
        "/" +
        selectedOption +
        "/" +
        (soptionValues.length ? soptionValues.join(",") : "1");
    console.log(url);
    console.log(selectValues);
    console.log(selectedOption);
    // AJAX 요청 보내기

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            setMarkers();
            console.log(markers);
            markers = [];
            markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);
            map.setCenter(
                new kakao.maps.LatLng(data["latlng"].lat, data["latlng"].lng)
            );
            // 지도에 표시된 마커 객체를 가지고 있을 배열입니다
            map.setLevel(level);
            for (let i = 0; i < data["sinfo"].length; i++) {
                // 마커 하나를 지도위에 표시합니다
                addMarker(
                    new kakao.maps.LatLng(
                        data["sinfo"][i].s_log,
                        data["sinfo"][i].s_lat
                    )
                );
                // 마커에 커서가 오버됐을 때 마커 위에 표시할 인포윈도우를 생성합니다
                iwContent[
                    i
                ] = `<div style="padding:5px;"><b>${data["sinfo"][i].s_name}</b>(${data["sinfo"][i].s_type})</div>`; // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다

                // 인포윈도우를 생성합니다
                infowindow[i] = new kakao.maps.InfoWindow({
                    content: iwContent[i],
                });

                kakao.maps.event.addListener(marker, "click", function () {
                    alert("marker click!");
                });

                kakao.maps.event.addListener(
                    markers[i],
                    "mouseover",
                    function () {
                        // 마커에 마우스오버 이벤트가 발생하면 인포윈도우를 마커위에 표시합니다
                        infowindow[i].open(map, markers[i]);
                    }
                );

                // 마커에 마우스아웃 이벤트를 등록합니다
                kakao.maps.event.addListener(
                    markers[i],
                    "mouseout",
                    function () {
                        // 마커에 마우스아웃 이벤트가 발생하면 인포윈도우를 제거합니다
                        infowindow[i].close();
                    }
                );
            }
            let ssum = 0;
            for (let i = 0; i < data["savg"].length; i++) {
                ssum += data["savg"][i].p_deposit;
            }
            let savg1 = ssum / data["savg"].length;
            let savg = isNaN(savg1) ? "0" : savg1;
            var container = document.getElementById("sidebar");
            container.innerText = "";
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
            accordionButton.textContent = `${
                selectedOption == "구 선택" ? "전체 구" : selectedOption
            }의평균매매가`;

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
            accordionBody.innerHTML = `${
                selectedOption == "구 선택" ? "전체 구" : selectedOption
            }의 평균 : ${savg.toLocaleString("ko-KR")}만원`;

            // 요소들을 구조에 맞게 추가
            accordionHeader.appendChild(accordionButton);
            accordionCollapse.appendChild(accordionBody);
            accordionItem.appendChild(accordionHeader);
            accordionItem.appendChild(accordionCollapse);
            accordion.appendChild(accordionItem);

            // 최종적으로 생성된 구조를 원하는 위치에 추가
            // var container = document.getElementById("sidebar"); // 적절한 컨테이너 요소 선택
            container.appendChild(accordion);
            // 마커를 생성하고 지도위에 표시하는 함수입니다

            for (let i = 0; i < data["sinfo"].length; i++) {
                var card = document.createElement("div");
                // 카드 요소 생성
                card.className = "card";
                card.style.width = "18rem";

                // 이미지 요소 생성
                var image = document.createElement("img");
                image.src = data["sinfo"][i].url; // 이미지 소스를 설정해주세요
                image.className = "card-img-top";
                image.alt = "..."; // 대체 텍스트를 설정해주세요

                // 카드 바디 요소 생성
                var cardBody = document.createElement("div");
                cardBody.className = "card-body";

                // 카드 내용 생성
                var cardText = document.createElement("p");
                cardText.className = "card-text";
                cardText.innerHTML =
                    "매매유형 : " +
                    data["sinfo"][i].s_type +
                    "<br>주소 : " +
                    data["sinfo"][i].s_add;

                // 요소들을 조합하여 구조 생성
                cardBody.appendChild(cardText);
                card.appendChild(image);
                card.appendChild(cardBody);
                var container = document.getElementById("sidebar");
                // 생성한 카드를 원하는 위치에 추가
                container.appendChild(card);
            }
        });
});

// 드롭다운 토글 버튼 클릭 이벤트 처리
document.addEventListener("click", function (event) {
    const dropdownToggle = event.target.closest(".dropdown-toggle");
    if (dropdownToggle) {
        const dropdownMenu = dropdownToggle.nextElementSibling;
        dropdownMenu.classList.toggle("open");
    }
});

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
        console.log(value);
        let url =
            "http://127.0.0.1:8000/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1");
        console.log(url);
        console.log(selectValues);
        console.log(selectedOption);
        // AJAX 요청 보내기

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                // 지도에 표시된 마커 객체를 가지고 있을 배열입니다
                setMarkers();
                console.log(markers);
                markers = [];
                var markerImage = new kakao.maps.MarkerImage(
                    imageSrc,
                    imageSize
                );
                map.setLevel(level);
                for (let i = 0; i < data["sinfo"].length; i++) {
                    // 마커 하나를 지도위에 표시합니다
                    addMarker(
                        new kakao.maps.LatLng(
                            data["sinfo"][i].s_log,
                            data["sinfo"][i].s_lat
                        )
                    );
                    // 마커에 커서가 오버됐을 때 마커 위에 표시할 인포윈도우를 생성합니다
                    iwContent[
                        i
                    ] = `<div style="padding:5px;"><b>${data["sinfo"][i].s_name}</b>(${data["sinfo"][i].s_type})</div>`; // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다

                    // 인포윈도우를 생성합니다
                    infowindow[i] = new kakao.maps.InfoWindow({
                        content: iwContent[i],
                    });

                    kakao.maps.event.addListener(marker, "click", function () {
                        alert("marker click!");
                    });

                    kakao.maps.event.addListener(
                        markers[i],
                        "mouseover",
                        function () {
                            // 마커에 마우스오버 이벤트가 발생하면 인포윈도우를 마커위에 표시합니다
                            infowindow[i].open(map, markers[i]);
                        }
                    );

                    // 마커에 마우스아웃 이벤트를 등록합니다
                    kakao.maps.event.addListener(
                        markers[i],
                        "mouseout",
                        function () {
                            // 마커에 마우스아웃 이벤트가 발생하면 인포윈도우를 제거합니다
                            infowindow[i].close();
                        }
                    );
                }
                let ssum = 0;
                for (let i = 0; i < data["savg"].length; i++) {
                    ssum += data["savg"][i].p_deposit;
                }
                let savg1 = ssum / data["savg"].length;
                let savg = isNaN(savg1) ? "0" : savg1;
                var container = document.getElementById("sidebar");
                container.innerText = "";
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
                accordionButton.textContent = `${
                    selectedOption == "구 선택" ? "전체 구" : selectedOption
                }의평균매매가`;

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
                accordionBody.innerHTML = `${
                    selectedOption == "구 선택" ? "전체 구" : selectedOption
                }의 평균 : ${savg.toLocaleString("ko-KR")}원`;

                // 요소들을 구조에 맞게 추가
                accordionHeader.appendChild(accordionButton);
                accordionCollapse.appendChild(accordionBody);
                accordionItem.appendChild(accordionHeader);
                accordionItem.appendChild(accordionCollapse);
                accordion.appendChild(accordionItem);

                // 최종적으로 생성된 구조를 원하는 위치에 추가
                // var container = document.getElementById("sidebar"); // 적절한 컨테이너 요소 선택
                container.appendChild(accordion);
                // 마커를 생성하고 지도위에 표시하는 함수입니다

                for (let i = 0; i < data["sinfo"].length; i++) {
                    var card = document.createElement("div");
                    // 카드 요소 생성
                    card.className = "card";
                    card.style.width = "18rem";

                    // 이미지 요소 생성
                    var image = document.createElement("img");
                    image.src = data["sinfo"][i].url; // 이미지 소스를 설정해주세요
                    image.className = "card-img-top";
                    image.alt = "..."; // 대체 텍스트를 설정해주세요

                    // 카드 바디 요소 생성
                    var cardBody = document.createElement("div");
                    cardBody.className = "card-body";

                    // 카드 내용 생성
                    var cardText = document.createElement("p");
                    cardText.className = "card-text";
                    cardText.innerHTML =
                        "매매유형 : " +
                        data["sinfo"][i].s_type +
                        "<br>주소 : " +
                        data["sinfo"][i].s_add;

                    // 요소들을 조합하여 구조 생성
                    cardBody.appendChild(cardText);
                    card.appendChild(image);
                    card.appendChild(cardBody);
                    var container = document.getElementById("sidebar");
                    // 생성한 카드를 원하는 위치에 추가
                    container.appendChild(card);
                }
            });
    });
});

const getpark = document.getElementById("getpark");
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
        console.log(value);
        let url =
            "http://127.0.0.1:8000/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1");
        console.log(url);
        console.log(selectValues);
        console.log(selectedOption);
        // AJAX 요청 보내기

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                const servicekey =
                    "cHVjVjglbOBfaJaLkhiSbBrRU2U3MkuefQS0rxexSVZcSA8vF6zeNrhf7LmjNlJGibN%2BM%2BPpK9GGjbmpsfD7FA%3D%3D";
                let pageno = 0;
                let numofrows = 10;
                let radius = "3";

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
                console.log(url);
                fetch(url)
                    .then((response) => response.json())
                    .then((data1) => {
                        console.log(data1.body.items.item);
                        console.log(data1);
                        let getdata = data1.body.items.item;
                        var imageSrc = "mapp.png";
                        var imageSize = new kakao.maps.Size(24, 35);
                        var markerImage = new kakao.maps.MarkerImage(
                            imageSrc,
                            imageSize
                        );
                        for (let i = 0; i < getdata.length; i++) {
                            console.log(getdata[i].lat, getdata[i].lot);
                            let markerPosition = new kakao.maps.LatLng(
                                getdata[i].lat,
                                getdata[i].lot
                            );

                            marker = new kakao.maps.Marker({
                                position: markerPosition,
                                image: markerImage,
                            });

                            marker.setMap(map);
                            // 생성된 마커를 배열에 추가합니다
                            pmarkers.push(marker);
                            console.log(pmarkers);
                        }
                    });
            });
    } else {
        for (var i = 0; i < pmarkers.length; i++) {
            pmarkers[i].setMap(null);
        }
        pmarkers = [];
    }
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
        console.log(value);
        let url =
            "http://127.0.0.1:8000/api/mapopt/" +
            (selectValues.length ? selectValues.join(",") : "1") +
            "/" +
            selectedOption +
            "/" +
            (soptionValues.length ? soptionValues.join(",") : "1");
        console.log(url);
        console.log(selectValues);
        console.log(selectedOption);
        console.log(soptionValues);
        // AJAX 요청 보내기

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                // 지도에 표시된 마커 객체를 가지고 있을 배열입니다
                setMarkers();
                console.log(markers);
                markers = [];
                var imageSrc = "maphome.png";
                var imageSize = new kakao.maps.Size(24, 35);
                var markerImage = new kakao.maps.MarkerImage(
                    imageSrc,
                    imageSize
                );
                map.setLevel(level);
                for (let i = 0; i < data["sinfo"].length; i++) {
                    // 마커 하나를 지도위에 표시합니다
                    addMarker(
                        new kakao.maps.LatLng(
                            data["sinfo"][i].s_log,
                            data["sinfo"][i].s_lat
                        )
                    );
                    // 마커에 커서가 오버됐을 때 마커 위에 표시할 인포윈도우를 생성합니다
                    iwContent[
                        i
                    ] = `<div style="padding:5px;"><b>${data["sinfo"][i].s_name}</b>(${data["sinfo"][i].s_type})</div>`; // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다

                    // 인포윈도우를 생성합니다
                    infowindow[i] = new kakao.maps.InfoWindow({
                        content: iwContent[i],
                    });

                    kakao.maps.event.addListener(marker, "click", function () {
                        alert("marker click!");
                    });

                    kakao.maps.event.addListener(
                        markers[i],
                        "mouseover",
                        function () {
                            // 마커에 마우스오버 이벤트가 발생하면 인포윈도우를 마커위에 표시합니다
                            infowindow[i].open(map, markers[i]);
                        }
                    );

                    // 마커에 마우스아웃 이벤트를 등록합니다
                    kakao.maps.event.addListener(
                        markers[i],
                        "mouseout",
                        function () {
                            // 마커에 마우스아웃 이벤트가 발생하면 인포윈도우를 제거합니다
                            infowindow[i].close();
                        }
                    );
                }
                let ssum = 0;
                for (let i = 0; i < data["savg"].length; i++) {
                    ssum += data["savg"][i].p_deposit;
                }
                let savg1 = ssum / data["savg"].length;
                let savg = isNaN(savg1) ? "0" : savg1;
                var container = document.getElementById("sidebar");
                container.innerText = "";
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
                accordionButton.textContent = `${
                    selectedOption == "구 선택" ? "전체 구" : selectedOption
                }의평균매매가`;

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
                accordionBody.innerHTML = `${
                    selectedOption == "구 선택" ? "전체 구" : selectedOption
                }의 평균 : ${savg.toLocaleString("ko-KR")}원`;

                // 요소들을 구조에 맞게 추가
                accordionHeader.appendChild(accordionButton);
                accordionCollapse.appendChild(accordionBody);
                accordionItem.appendChild(accordionHeader);
                accordionItem.appendChild(accordionCollapse);
                accordion.appendChild(accordionItem);

                // 최종적으로 생성된 구조를 원하는 위치에 추가
                // var container = document.getElementById("sidebar"); // 적절한 컨테이너 요소 선택
                container.appendChild(accordion);
                // 마커를 생성하고 지도위에 표시하는 함수입니다

                for (let i = 0; i < data["sinfo"].length; i++) {
                    var card = document.createElement("div");
                    // 카드 요소 생성
                    card.className = "card";
                    card.style.width = "18rem";

                    // 이미지 요소 생성
                    var image = document.createElement("img");
                    image.src = data["sinfo"][i].url; // 이미지 소스를 설정해주세요
                    image.className = "card-img-top";
                    image.alt = "..."; // 대체 텍스트를 설정해주세요

                    // 카드 바디 요소 생성
                    var cardBody = document.createElement("div");
                    cardBody.className = "card-body";

                    // 카드 내용 생성
                    var cardText = document.createElement("p");
                    cardText.className = "card-text";
                    cardText.innerHTML =
                        "매매유형 : " +
                        data["sinfo"][i].s_type +
                        "<br>주소 : " +
                        data["sinfo"][i].s_add;

                    // 요소들을 조합하여 구조 생성
                    cardBody.appendChild(cardText);
                    card.appendChild(image);
                    card.appendChild(cardBody);
                    var container = document.getElementById("sidebar");
                    // 생성한 카드를 원하는 위치에 추가
                    container.appendChild(card);
                }
            });
    });
});
