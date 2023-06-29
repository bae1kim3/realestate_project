<x-authentication-card>
    <x-slot name="logo">
    </x-slot>

    <x-slot name="logo">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
        </h1>
    </x-slot>

    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <form wire:submit.prevent="findUserPwAnswer">
            <x-label for="pw_answer" class="block dark:text-white">질문: {{ session('pw_question') }}</x-label>
            <x-input type="text" wire:model="pw_answer" placeholder="답변 입력"
                class="block mt-1 w-full dark:bg-gray-700 dark:text-white" />
            <br />
            <x-button class="dark:bg-gray-400">비밀번호 찾기</x-button>
            @if (Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
        </form>
    </div>
</x-authentication-card>
@include('layouts.footer')

