<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <form action="{{route('profile.chk_del_user.post')}}" method="post" id="deleteForm">
    @csrf
        <input type="password" name="password" placeholder="비밀번호 입력">
        {{-- 유효성 검사 --}}
        @foreach($errors->all() as $error)
          <div class="alert alert-success" role="alert">
              {{ $error }}
          </div>
        @endforeach
        {{-- 비밀번호 db에 없을때 --}}
        @if(session()->has('error'))
        <div>
        {{session()->get('error')}}
        </div>
        @endif
    </form>
    {{-- <button type="button" onclick="withdrawal()" id="confirmBtn" >탈퇴</button> --}}
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    탈퇴
    </button>



{{-- Modal --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirmBtn" onclick="withdrawal()">Understood</button>
      </div>
    </div>
  </div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="{{asset('del_user.js')}}"></script>
</body>
</html>
