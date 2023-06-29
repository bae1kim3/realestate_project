<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
            </h2>
        </x-slot>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if (session('success'))
            <?php session()->flush(); ?>
            <script>
                window.addEventListener('DOMContentLoaded', (event) => {
                    alert('비밀번호 변경 성공 로그인 해주세요');
                });
            </script>
        @endif

        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-label for="u_id" value="{{ __('User ID') }}" class="dark:text-gray-100" />
                    <x-input id="u_id" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="text"
                        name="u_id" :value="old('u_id')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="dark:text-gray-100" />
                    <x-input id="password" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="password"
                        name="password" required autocomplete="current-password" />
                </div>

                <div class="mt-4">
                    <x-label for="seller_license" value="{{ __('Seller License') }}" class="dark:text-gray-100" />
                    <x-input id="seller_license" class="block mt-1 w-full dark:bg-gray-700 dark:text-white"
                        type="text" name="seller_license" required autocomplete="current-seller_license" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" class="dark:bg-gray-700" />
                        <span class="dark:text-gray-100">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <p class="text-right mt-2">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-100"
                        href="{{ route('find-username') }}">
                        {{ __('아이디를 잊었나요?') }}
                    </a>
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-100"
                        href="{{ route('find-userpassinput') }}">
                        {{ __('비밀번호를 잊었나요?') }}
                    </a>
                </p>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="dark:bg-gray-400">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
@include('layouts.footer')
