var loadingPhotos = false; 
    var photosLoaded = 0; 

    function loadMorePhotos() {
        if (loadingPhotos) return; // 로딩 중인 경우 중복 로드 방지
        loadingPhotos = true; // 로딩 상태로 변경

        var lastPhotoId = document.querySelector('.photo-item:last-child').getAttribute('data-value');
        var url = '/photos/more/' + lastPhotoId;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var newPhotosHtml = generatePhotoHtml(response.photos);
                var scrollContainer = document.getElementById('scroll-container');
                scrollContainer.insertAdjacentHTML('beforeend', newPhotosHtml);
                loadingPhotos = false; // 로딩 완료 상태로 변경

                photosLoaded += response.photos.length; // 갱신된 사진 수 추가
                if (photosLoaded >= 19) { // 최대로 갱신될 사진 숫자
                    scrollContainer.removeEventListener('scroll', scrollHandler); // 설정한 숫자 이상일 경우 스크롤 이벤트 제거
                }
            } else {
                console.error('Error: ' + xhr.status);
            }
        };
        xhr.send();
    }

    function generatePhotoHtml(photos) {
        var html = '';
        photos.forEach(function(photo) {
            html += '<img class="photo-item mr-4 dark:bg-red-800" src="' + photo.url + '" alt="Photo">';
        });
        return html;
    }

    var scrollContainer = document.getElementById('scroll-container');
    var scrollHandler = function() {
        if (scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth) {
            loadMorePhotos();
        }
    };

    scrollContainer.addEventListener('scroll', scrollHandler);

    function searchProperties() {
        var searchInput = document.getElementById('search').value;
        var url = '/search?keyword=' + encodeURIComponent(searchInput);

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var properties = response.properties;

                // 검색 결과에 맞는 사진을 가져오는 함수 호출
                loadPhotosForProperties(properties);
            } else {
                console.error('Error: ' + xhr.status);
            }
        };
        xhr.send();
    }

    function loadPhotosForProperties(properties) {
        var scrollContainer = document.getElementById('scroll-container');
        scrollContainer.innerHTML = ''; // 기존의 사진을 제거

        properties.forEach(function(property) {
            var photoHtml = generatePhotoHtmlSingle(property.photoUrl);
            scrollContainer.insertAdjacentHTML('beforeend', photoHtml);
        });
    }

    function generatePhotoHtmlSingle(photoUrl) {
        return '<img class="photo-item mr-4 dark:bg-red-800" src="' + photoUrl + '" alt="Photo">';
    }