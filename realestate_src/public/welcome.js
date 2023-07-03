// 아코디언
const accordionItems = document.querySelectorAll('.accordion-item');

accordionItems.forEach(item => {
  const title = item.querySelector('.accordion-title');
  title.addEventListener('click', () => {
    const isActive = item.classList.contains('active');
    accordionItems.forEach(item => item.classList.remove('active'));
    if (!isActive) {
      item.classList.add('active');
    }
  });
});

const accordionItems2 = document.querySelectorAll('.accordion-item2');

accordionItems2.forEach(item => {
  const title = item.querySelector('.accordion-title');
  title.addEventListener('click', () => {
    const isActive = item.classList.contains('active2');
    accordionItems2.forEach(item => item.classList.remove('active2'));
    if (!isActive) {
      item.classList.add('active2');
    }
  });
});

// 가로스크롤 부동산 정보 갱신
var loadingPhotos = false;
var lastPhotoId = document.querySelector('#lastPhotoItem').dataset.id;

function loadMorePhotos() {
    if (loadingPhotos) return;
    loadingPhotos = true;
    var url = '/photos/more/' + lastPhotoId;

    var searchQuery = document.getElementById('search').value;
    url += '?search=' + searchQuery;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var scrollContainer = document.getElementById('scroll-container');
            var newPhotos = response.photos.slice(0, 5);
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
    var html =  '<a href="/sDetail/' + photo.s_no + '">' +
        '<div class="photo-item" style="background-image: url(\'' + photo.url + '\');">' +
        '<span class="photo-info">' +
        '<span class="info-text">' + photo.s_add + '</span><br>' +
        '<span class="info-text">' + deposit + '</span>';

    if (photo.s_type === '월세') {
        html += '<span class="info-text"> / ' + photo.p_month.toLocaleString() + '</span>';
    }
    html += '<br><span class="info-text">' + photo.updated_at.substr(0, 10) + '</span>' +
        '</span>' +
        '</div>' +
        '</a>';

    html += '<input type="hidden" id="lastPhotoItem" data-id="' + lastPhotoId + '">';

    return html;
}

var scrollContainer = document.getElementById('scroll-container');
var scrollHandler = function () {
    if (scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth - 1) {
        loadMorePhotos();
    }
};

function attachScrollHandler() {
    scrollContainer.addEventListener('scroll', scrollHandler);
  }

attachScrollHandler();

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
            attachScrollHandler();
        } else {
            console.error('Error: ' + xhr.status);
        }
    };
    xhr.send();
}