{{-- <x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="deluser.css">
<div class="con">
    <div class="del_box">
      <div class="del_border">
        <div class="content">
        <form action="{{route('profile.chk_del_user.post')}}" method="post" id="deleteForm" onsubmit="return false;">
        @csrf
            <div>아이디 : {{Auth::user()->u_id}}</div>
            <input class="input_pw mt-3" type="password" name="password" placeholder="비밀번호 입력">
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color:red!important;">
          탈퇴
          </button>
        </form> --}}
            {{-- 유효성 검사 --}}
            {{-- @foreach($errors->all() as $error)
              <div class="alert alert-success" role="alert">
                  {{ $error }}
              </div>
            @endforeach --}}
            {{-- 비밀번호 db에 없을때 --}}
            {{-- @if(session()->has('error'))
            <div class="err">
            {{session()->get('error')}}
            @endif
            </div>
        </div>
    </div>
  </div> --}}



{{-- Modal --}}
{{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">회원 탈퇴</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        정말로 탈퇴하시겠습니까? 모든 정보가 지워집니다.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-danger" id="confirmBtn" onclick="withdrawal()">이해했습니다</button>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')

<script src="{{asset('del_user.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</div>
</x-app-layout> --}}
{{-- <link rel="stylesheet" href="deluser.css"> --}}
<style>
       .hidden{
        display: none;
    }
    #modal{
        width: 100%;
        top: 25%;
        left: 0;
        z-index: 9999;
        position: fixed;
        align-items: center;
        text-align: center;
        /* height: 100%; */
        /* position: fixed; */
        /* justify-content: center; */
    }
    /* #modal {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        z-index: 9999;
    }*/
    p {
            color: white;
            margin: 0px 10px
        }

        li {
            color: gray;
        }

        .test {
            display: none;
        }

        .color {
            color: white;
        }

        .color2 {
            color: gray;
        }

    #modaldiv {
        margin: 0 auto;
        width: 320px;
        text-align: center;
        border: 1px solid #89a5ea;
        background-color: #929292;
        padding: 20px;
        border-radius: 8px;
    }
</style>
<x-app-layout>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v17.0&appId=673307384664484&autoLogAppEvents=1" nonce="NZqU5Vh2"></script>
<div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">회원탈퇴</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li id="use" sytle="color:white"><a href="{{ route('welcome') }}">메인</a></li>
                        <p> / </p>
                        <li id="sell">
                            회원탈퇴
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-info">
                    <div class="address mt-2">
                        <i class="icon-room"></i>
                        <h4 class="mb-2">개발위치:</h4>
                        <p style="color:black">
                            대구광역시 중구 동성로<br />
                            그린컴퓨터 아트학원 5층
                        </p>
                    </div>

                    <div class="open-hours mt-4">
                        <i class="icon-clock-o"></i>
                        <h4 class="mb-2">연락가능 시간:</h4>
                        <p style="color:black">
                            Sunday-Friday:<br />
                            11:00 AM - 18:00 PM
                        </p>
                    </div>

                    <div class="email mt-4">
                        <i class="icon-envelope"></i>
                        <h4 class="mb-2">이메일:</h4>
                        <p style="color:black">faer9876@naver.com</p>
                    </div>

                    <div class="phone mt-4">
                        <i class="icon-phone"></i>
                        <h4 class="mb-2">전화번호:</h4>
                        <p style="color:black">+82 010 6625 6834</p>
                    </div>
                </div>
            </div>

{{-- 회원탈퇴 --}}
<div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
    <form action="{{ route('profile.chk_del_user.post') }}" method="POST" id="deleteForm">
        @csrf
        <div>아이디 : {{Auth::user()->u_id}}</div>
        <div class="col-6 mb-3">
        <x-input type="password" name="password" placeholder="비밀번호 입력"
        class="form-control"></x-input>
        </div>
        {{-- 유효성 검사 --}}
        {{-- @foreach($errors->all() as $error)
          <div class="alert alert-success" role="alert">
              {{ $error }}
          </div>
            @endforeach --}}
        {{-- 비밀번호 db에 없을때 --}}
        @if(session()->has('error'))
          <div class="err" style="color:red; margin:10px 0">
          {{session()->get('error')}}
          </div>
        @endif
        <x-button type="button" id="delBtn" onclick="clickDel()" class="btn btn-primary py-2 px-3">탈퇴</x-button>
    </form>
</div>


{{-- 탈퇴 모달 --}}
        <div id="modal" class="hidden">
            <div id="modaldiv" style="border: 1px solid black; background-color:white;" class="dark:bg-gray-900 rounded-lg p-6 shadow-md">
                <h1 id="modalTitle" class="text-lg font-bold mb-4" style="color:green">회원 탈퇴</h1>
                <p id="modalMessage" style="color:green">정말로 탈퇴하시겠습니까? 모든 정보가 지워집니다.</p>
                <button id="modalCloseBtn" onclick="closeModal()" class="btn btn-primary py-2 px-3">
                    닫기
                </button>
                <button type="button" class="btn btn-primary py-2 px-3" id="confirmBtn" onclick="withdrawal()" style="margin-left:10px; background-color:red">이해했습니다</button>
            </div>
        </div>


<script>
    const confirmBtn = document.getElementById("confirmBtn");
    const modalCloseBtn = document.getElementById("modalCloseBtn");
    const modal = document.getElementById("modal");
    const delBtn = document.getElementById("delBtn");

    // 모달 열기
    delBtn.addEventListener("click", function() {
      modal.classList.remove("hidden");
    });

    // 회원 탈퇴 실행
    confirmBtn.addEventListener("click", function() {
      let form = document.getElementById("deleteForm");
      form.submit();
      return false;
    });

    // 모달 닫기
    modalCloseBtn.addEventListener("click", function() {
      modal.classList.add("hidden");
    });

</script>
</x-app-layout>




