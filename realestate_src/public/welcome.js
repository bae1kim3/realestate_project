// 아코디언
// 3차때 빼기로 해서 삭제
// const accordionItems = document.querySelectorAll('.accordion-item');

// accordionItems.forEach(item => {
//   const title = item.querySelector('.accordion-title');
//   title.addEventListener('click', () => {
//     const isActive = item.classList.contains('active');
//     accordionItems.forEach(item => item.classList.remove('active'));
//     if (!isActive) {
//       item.classList.add('active');
//     }
//   });
// });

// const accordionItems2 = document.querySelectorAll('.accordion-item2');

// accordionItems2.forEach(item => {
//   const title = item.querySelector('.accordion-title');
//   title.addEventListener('click', () => {
//     const isActive = item.classList.contains('active2');
//     accordionItems2.forEach(item => item.classList.remove('active2'));
//     if (!isActive) {
//       item.classList.add('active2');
//     }
//   });
// });

// // 가로스크롤 부동산 정보 갱신
// 3차때 가로스크롤 없애기로 해서 삭제
// var loadingPhotos = false;
// var lastPhotoId = document.querySelector('#lastPhotoItem').dataset.id;

// function loadMorePhotos() {
//     if (loadingPhotos) return;
//     loadingPhotos = true;
//     var url = '/photos/more/' + lastPhotoId;

//     var searchQuery = document.getElementById('search').value;
//     url += '?search=' + searchQuery;

//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', url);
//     xhr.onload = function () {
//         if (xhr.status === 200) {
//             var response = JSON.parse(xhr.responseText);
//             var scrollContainer = document.getElementById('scroll-container');
//             var newPhotos = response.photos.slice(0, 5);
//             newPhotos.forEach(function (photo) {
//                 var newPhotosHtml = generatePhotoHtml(photo, response.lastPhotoId);
//                 scrollContainer.insertAdjacentHTML('beforeend', newPhotosHtml);
//             });
//             if (response.lastPhotoId >= 20) {
//                 scrollContainer.removeEventListener('scroll', scrollHandler);
//                 loadingPhotos = false;
//                 return;
//             }
            
//             loadingPhotos = false;
//             lastPhotoId = response.lastPhotoId;
//         } else {
//             console.error('Error: ' + xhr.status);
//         }
//     };
//     xhr.send();
// }

// function generatePhotoHtml(photo, lastPhotoId) {
//     var deposit = photo.p_deposit.toLocaleString();
//     var html =  '<a href="/sDetail/' + photo.s_no + '">' +
//         '<div class="photo-item" style="background-image: url(\'' + photo.url + '\');">' +
//         '<span class="photo-info">' +
//         '<span class="info-text">' + photo.s_add + '</span><br>' +
//         '<span class="info-text">' + deposit + '</span>';

//     if (photo.s_type === '월세') {
//         html += '<span class="info-text"> / ' + photo.p_month.toLocaleString() + '</span>';
//     }
//     html += '<br><span class="info-text">' + photo.updated_at.substr(0, 10) + '</span>' +
//         '</span>' +
//         '</div>' +
//         '</a>';

//     html += '<input type="hidden" id="lastPhotoItem" data-id="' + lastPhotoId + '">';

//     return html;
// }



// 3차때 가로스크롤 갱신 없애서 삭제
// var scrollContainer = document.getElementById('scroll-container');
// var scrollHandler = function () {
    //     if (scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth - 1) {
        //         loadMorePhotos();
        //     }
        // };
        
        
        // function attachScrollHandler() {
            //     scrollContainer.addEventListener('scroll', scrollHandler);
            //   }
            // attachScrollHandler();
            
// html 생성 폼
function generatePropertyItemHtml(photo) {
    var deposit = photo.p_deposit.toLocaleString();
    var html = 
        '<a href="/sDetail/' + photo.s_no + '" class="img">' +
        '<img src="' + photo.url + '" alt="Image" class="img-fluid" style="width: 350px; height: 300px; margin-bottom: 50px;" />' +
        '</a>' +
        '<div class="property-content">' +
        '<div class="price mb-2"><span>' + photo.s_name + '</span></div>' +
        '<div>' +
        '<span class="d-block mb-2 text-black-50">' + photo.s_add + '</span>' +
        '<span class="city d-block mb-3">' + deposit;

    if (photo.s_type === '월세') {
        var monthDeposit = photo.p_month.toLocaleString();
        html += ' / ' + monthDeposit;
    }

    html += '</span>' +
        '<div class="specs d-flex mb-4">' +
        '<span class="d-block d-flex align-items-center me-3">' +
        '<span class="icon-building me-2"></span>' +
        '<span class="caption">';

    switch (photo.s_option) {
        case 0:
            html += '아파트';
            break;
        case 1:
            html += '단독주택';
            break;
        case 2:
            html += '오피스텔';
            break;
        case 3:
            html += '빌라';
            break;
        case 4:
            html += '원룸';
            break;
        default:
            break;
    }

    html += '</span>' +
        '</span>' +
        '<span class="d-block d-flex align-items-center">' +
        '<span class="fa-solid fa-dog me-2"></span>' +
        '<span class="caption"> 대형동물';

    switch (photo.animal_size) {
        case 0:
            html += ' <strong>X</strong>';
            break;
        case 1:
            html += ' <strong>O</strong>';
            break;
        default:
            break;
    }

    html += '</span>' +
        '</span>' +
        '</div>' +
        '<a href="/sDetail/' + photo.s_no + '" class="btn btn-primary py-2 px-3">매물 보러가기</a>' +
        '</div>' +
        '</div>' ;

    return html;
}

// 검색기능
function searchProperties() {
    var searchQuery = document.getElementById('search').value;
    var url = '/photos/more/' + 17 + '?search=' + searchQuery;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var itemContainer = document.getElementById('itemContainer');
            itemContainer.innerHTML = '';
            itemContainer.insertAdjacentHTML('beforeend', '<div class="property-item" style="width: 350px;"></div>');
            let choiceDiv = document.getElementsByClassName('property-item');
            response.photos.forEach(function (photo) {
                var newPhotosHtml = generatePropertyItemHtml(photo, 17);
                choiceDiv.insertAdjacentHTML('beforeend', newPhotosHtml);
            });
        } else {
            console.error('Error: ' + xhr.status);
        }
    };
    xhr.send();
}