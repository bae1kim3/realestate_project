<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('map.css')}}">
</head>
<body>
<div class="contents">
    <nav class="nav sticky-top justify-content-end p-3" style="background-color: #1f2937;">
        <a class="nav-link active link-light position-absolute top-50 start-0 translate-middle-y ms-4" aria-current="page" href="#">로고</a>
        <a class="nav-link link-light" href="#" id="aa">찜 목록</a>
        <a class="nav-link link-light" href="#" id="aa">방 내놓기</a>
        <button id="getpark">주변 시설</button>
            <select id="option" name="gu" >
            <option>구 선택</option>
            <option id="option" value="달서구">달서구</option>
            <option id="option" value="달성군">달성군</option>
            <option id="option" value="동구" >동구</option>
            <option id="option" value="서구" >서구</option>
            <option id="option" value="남구" >남구</option>
            <option id="option" value="북구" >북구</option>
            <option id="option" value="수성구" >수성구</option>
            <option id="option" value="중구" >중구</option>
            </select>
        <div class="dropdown">
            <div class="dropdown-toggle" data-toggle="dropdown">
                건물 유형
            </div>
            <div class="dropdown-menu">
                <label>
                <input type="checkbox" id="opt" name="option4" value="월세" > 월세
                </label>
                <label>
                <input type="checkbox" id="opt" name="option5" value="전세" > 전세
                </label>
                <label>
                <input type="checkbox" id="opt" name="option6" value="매매" > 매매
                </label>
            </div>
        </div>
        <div class="dropdown">
            <div class="dropdown-toggle" data-toggle="dropdown">
                건물 옵션
            </div>
            <div class="dropdown-menu">
                <label>
                <input type="checkbox" id="opt1" name="option4" value="주차장" > 주차
                </label>
                <label>
                <input type="checkbox" id="opt1" name="option6" value="ele" > 엘
                </label>
            </div>
        </div>
        <button type="button" class="btn btn-dark" id="aa">로그인</button>
    </nav>
    <div class="container1">
        <div class="sidebar" id="sidebar">
        </div>
        <div id="map"></div>
    </div>
</div>
<div></div>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=9abea084b391e97658a9380c837b9608&libraries=services,clusterer,drawing"></script>
    <script src="{{asset('map.js')}}"></script>
</body>
</html>
