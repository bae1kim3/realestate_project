<x-authentication-card>
    <x-slot name="logo">
    </x-slot>

    <x-slot name="logo">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
        </h1>
    </x-slot>

    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <form wire:submit.prevent="findUserPwQuestion" method="post">
            <x-label for="email" value="{{ __('이메일') }}" class="dark:text-gray-100" />
            <x-input type="email" wire:model="email" placeholder="이메일 입력"
                class="block mt-1 w-full dark:bg-gray-700 dark:text-white" />
            <br>
            <x-label for="phone_no" value="{{ __('전화번호') }}" class="dark:text-gray-100" />
            <x-input type="text" wire:model="phone_no" placeholder="전화번호 입력"
                class="block mt-1 w-full dark:bg-gray-700 dark:text-white" />
            <br />
            <x-button class="dark:bg-gray-400">입력</x-button>
            @if (Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
        </form>
    </div>
</x-authentication-card>

@include('layouts.footer')
