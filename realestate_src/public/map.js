var loadingPhotos = false;
var lastPhotoId = document.querySelector('#lastPhotoItem').dataset.id;

function loadMorePhotos() {
    if (loadingPhotos) return;
    loadingPhotos = true;
    var url = '/photos/more/' + lastPhotoId;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var scrollContainer = document.getElementById('scroll-container');
            var newPhotos = response.photos.slice(0, 3);
            newPhotos.forEach(function (photo) {
                var newPhotosHtml = generatePhotoHtml(photo, response.lastPhotoId);
                scrollContainer.insertAdjacentHTML('beforeend', newPhotosHtml);
            });
            if (response.lastPhotoId >= 20) {
                scrollContainer.removeEventListener('scroll', scrollHandler);
                loadingPhotos = false;
                return;
            }

            loadingPhotos = false;
            lastPhotoId = response.lastPhotoId;
        } else {
            console.error('Error: ' + xhr.status);
        }
    };
    xhr.send();
}

function generatePhotoHtml(photo, lastPhotoId) {
    var deposit = photo.p_deposit.toLocaleString();
    var month = photo.p_month.toLocaleString();
    var html = '<div class="photo-item" style="background-image: url(\'' + photo.url + '\');">' +
        '<span class="photo-info">' +
        '<span class="info-text">' + photo.s_add + '</span><br>' +
        '<span class="info-text">' + deposit + '</span>';

    if (photo.s_type === '월세') {
        html += '<span class="info-text"> / ' + month + '</span>';
    }
    html += '<br><span class="info-text">' + photo.updated_at.substr(0, 10) + '</span>' +
        '</span>' +
        '</div>';

    html += '<input type="hidden" id="lastPhotoItem" data-id="' + lastPhotoId + '">';

    return html;
}

var scrollContainer = document.getElementById('scroll-container');
var scrollHandler = function () {
    if (scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth) {
        loadMorePhotos();
    }
};

scrollContainer.addEventListener('scroll', scrollHandler);

function searchProperties() {
    var searchQuery = document.getElementById('search').value;
    lastPhotoId = 0;
    var url = '/photos/more/' + lastPhotoId + '?search=' + searchQuery;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var scrollContainer = document.getElementById('scroll-container');
            scrollContainer.innerHTML = '';
            response.photos.forEach(function (photo) {
                var newPhotosHtml = generatePhotoHtml(photo, response.lastPhotoId);
                scrollContainer.insertAdjacentHTML('beforeend', newPhotosHtml);
            });
            if (response.lastPhotoId >= 20) {
                scrollContainer.removeEventListener('scroll', scrollHandler);
            }
            lastPhotoId = response.lastPhotoId;
        } else {
            console.error('Error: ' + xhr.status);
        }
    };
    xhr.send();
}
