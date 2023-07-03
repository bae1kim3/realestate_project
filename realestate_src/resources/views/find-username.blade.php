<x-guest-layout>
    <x-authentication-card>


        <x-slot name="logo">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
            </h2>
        </x-slot>
        <x-validation-errors class="mb-4" />

        {{-- 아이디찾기 --}}
        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <form id="findUsernameForm" action="{{ route('find-username.submit') }}" method="POST">
                @csrf
                <x-label for="email" class="block dark:text-white">{{ __('이메일') }}</x-label>
                <x-input type="email" name="email" placeholder="이메일 입력" class="block mt-1 w-full dark:bg-gray-700 dark:text-white"></x-input>
                <br>
                <x-button id="findUsernameBtn" class="dark:bg-gray-400">아이디 찾기</x-button>
            </form>
        </div>


        {{-- 아이디출력 모달 --}}
        <div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
            <div id="modaldiv" style="border: 1px solid #89a5ea; background-color:#929292;" class="rounded-lg p-6">
                <h1 id="modalTitle" class="text-lg font-bold mb-4"></h1>
                <p id="modalMessage"></p>
                <button id="modalCloseBtn" class="mt-6 bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                    닫기
                </button>
            </div>
        </div>

        <script src="{{asset('finduser.js')}}"></script>
    </x-authentication-card>
</x-guest-layout>
@include('layouts.footer')
