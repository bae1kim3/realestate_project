<x-guest-layout>
    <x-authentication-card>
        <x-slot name="header">
            {{ __('Select') }}
        </x-slot>
        <x-slot name="logo">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
            </h1>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @csrf
        <div class="flex items-center justify-center mt-4">
    <a href="{{ route('user-register') }}">
        <x-button style="margin:30px" class="dark:bg-gray-600">
            {{ __('일반 회원') }}
        </x-button>
    </a>

    <a href="{{ route('seller-register') }}">
        <x-button style="margin:30px" class="dark:bg-gray-600">
            {{ __('공인중개사 회원') }}
        </x-button>
    </a>
</div>
        </div>
    </x-authentication-card>
</x-guest-layout>
@include('layouts.footer')
