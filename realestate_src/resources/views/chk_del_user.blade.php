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
<link rel="stylesheet" href="deluser.css">
<x-app-layout>
  <x-authentication-card>

        <x-slot name="logo">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
            </h2>
        </x-slot>
        <x-validation-errors class="mb-4" />

{{-- 회원탈퇴 --}}
        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <form action="{{ route('profile.chk_del_user.post') }}" method="POST" id="deleteForm">
        @csrf
        <div>아이디 : {{Auth::user()->u_id}}</div>
        <x-input type="password" name="password" placeholder="비밀번호 입력"
            class="block mt-1 w-full dark:bg-gray-700 dark:text-white"></x-input>
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
        <x-button type="button" id="delBtn" onclick="clickDel()" class="mt-3 dark:bg-gray-400">탈퇴</x-button>
    </form>
</div>


{{-- 탈퇴 모달 --}}
        <div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
            <div id="modaldiv" style="border: 1px solid #89a5ea; background-color:#a1a0a0;" class="dark:bg-gray-900 rounded-lg p-6 shadow-md">
                <h1 id="modalTitle" class="text-lg font-bold mb-4">회원 탈퇴</h1>
                <p id="modalMessage">정말로 탈퇴하시겠습니까? 모든 정보가 지워집니다.</p>
                <button id="modalCloseBtn" onclick="closeModal()" class="mt-6 bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                    닫기
                </button>
                <button type="button" class="mt-6 bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded" id="confirmBtn" onclick="withdrawal()" style="margin-left:10px;">이해했습니다</button>            
            </div>
        </div>

</x-authentication-card>
<script src="{{asset('del_user.js')}}"></script>
@include('layouts.footer')
</x-app-layout>
