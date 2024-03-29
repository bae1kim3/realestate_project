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
        '<div class="property-item tns-item tns-slide-cloned" style="width: 350px;" aria-hidden="true" tabindex="-1">' +
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
        case '0':
            html += '아파트';
            break;
        case '1':
            html += '단독주택';
            break;
        case '2':
            html += '오피스텔';
            break;
        case '3':
            html += '빌라';
            break;
        case '4':
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
        case '0':
            html += ' <strong>X</strong>';
            break;
        case '1':
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
    var url = '/photos/more/' + '17' + '?search=' + searchQuery;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var itemContainer = document.getElementById('itemContainer');
            itemContainer.innerHTML = '';
            const h2Element = document.querySelector('.col-lg-6 h2.text-primary.heading');
            h2Element.textContent = '검색결과';
            // const checkElement = document.getElementById('search_chk');
            // // 버튼 초기화
            // checkElement.innerHTML = '';
            // // 버튼 요소를 생성합니다.
            // const button = document.createElement("button");
            // button.textContent = "대형동물";
            // button.setAttribute("style", "border:none; padding:16px 20px; border-radius:30px; margin-right:10px");
            // button.setAttribute("id", "animal_btn");
            // button.setAttribute("name", "animal_size");
            // // 체크박스 요소 생성
            // //월세
            // const labelMonth = document.createElement("label")
            // labelMonth.textContent = "월세";
            // labelMonth.setAttribute("for", "p_month");
            // const chkboxMonth = document.createElement("input")
            // chkboxMonth.setAttribute("type", "checkbox");
            // chkboxMonth.setAttribute("name", "p_month");
            // chkboxMonth.setAttribute("id", "p_month");
            // //전세
            // const labelJeonse = document.createElement("label")
            // labelJeonse.textContent = "전세";
            // labelJeonse.setAttribute("for", "p_jeonse");
            // const chkboxJeonse = document.createElement("input")
            // chkboxJeonse.setAttribute("type", "checkbox");
            // chkboxJeonse.setAttribute("name", "p_jeonse");
            // chkboxJeonse.setAttribute("id", "p_jeonse");
            // //매매
            // const labelSell = document.createElement("label")
            // labelSell.textContent = "매매";
            // labelSell.setAttribute("for", "p_sell");
            // const chkboxSell = document.createElement("input")
            // chkboxSell.setAttribute("type", "checkbox");
            // chkboxSell.setAttribute("name", "p_sell");
            // chkboxSell.setAttribute("id", "p_sell");
            // // 버튼을 "search_chk"라는 ID를 가진 요소에 추가합니다.
            // search_chk.appendChild(button);
            // search_chk.appendChild(labelMonth);
            // search_chk.appendChild(chkboxMonth);
            // search_chk.appendChild(labelJeonse);
            // search_chk.appendChild(chkboxJeonse);
            // search_chk.appendChild(labelSell);
            // search_chk.appendChild(chkboxSell);
            

            // checkElement.addEventListener("mouseover", () => {
            //     button.setAttribute("style", "border:none; padding:16px 20px; border-radius:30px; margin-right:10px; background-color: #00204a; color: white; transition: .3s all ease;");
            // });
            // checkElement.addEventListener("mouseout", () => {
            //     button.setAttribute("style", "border:none; padding:16px 20px; border-radius:30px; margin-right:10px; transition: .3s all ease;");
            // });


            // checkElement.addEventListener("click", () => {
            //     response.photos.filter(function(photo) {
            //         itemContainer.innerHTML = '';
            //         return photo.animal_size == '1';
            //     }).forEach(function (photo) {
            //         var newPhotosHtml = generatePropertyItemHtml(photo);
            //         itemContainer.insertAdjacentHTML('beforeend', newPhotosHtml);
            //         itemContainer.style.maxWidth = 300 * response.photos.length + "px";
            //     });
            // });
            response.photos.forEach(function (photo) {
                var newPhotosHtml = generatePropertyItemHtml(photo);
                itemContainer.insertAdjacentHTML('beforeend', newPhotosHtml);
                itemContainer.style.maxWidth = 300 * response.photos.length + "px";
                // slidebtn = document.querySelector('.tns-nav');
                // slidebtn.innerHTML='';
                // for (let i = 0; i < response.photos.length; i++) {
                //     var newBtn = generateBtn(i);
                //     slidebtn.insertAdjacentHTML('beforeend', newBtn);
                // }
            });
        } else {
            console.error('Error: ' + xhr.status);
        }
    }
    xhr.send();
}

// function generateBtn(i) {
//     var html = 
//         '<button type="button" data-nav="' + i + '" aria-controls="itemContainer" style aria-label="Carousel Page ' + (i + 1) + '" class tabindex="-1"></button>';
//     return html;
// }
// let btnAnimal = document.getElementById('animal_btn');
// let chkboxMonth = document.getElementById('p_month');
// let chkboxJeonse = document.getElementById('p_jeonse');
// let chkboxSell = document.getElementById('p_sell');
// // 버튼, 체크박스 클릭했을 때 

// btnAnimal.addEventListener('click', function() {
//     fetch('/checkbox', {
//         body: JSON.stringify({
//             animal_size: '1'
//         })
//     })
//     .then(response=> response.json())
    
// })