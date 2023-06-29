<x-app-layout>
    <x-authentication-card>
    <x-slot name="logo">
        <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
    </x-slot>

    <div>
        <form action="{{ route('updatePassword') }}" method="post">
            @csrf
                <div class="mt-4">
                    <x-label for="password" value="{{ __('새 비밀번호') }}" class="dark:text-white"/>
                    <x-input id="password" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('비밀번호 확인') }}" class="dark:text-white"/>
                    <x-input id="password_confirmation" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-button class="dark:bg-gray-400">
                    저장
                    </x-button>
                </div>
            </div>
        </form>

        @if ($errors->has('phone_no'))
            <div class="text-red-500">
                {{ $errors->first('phone_no') }}
            </div>
        @endif

        <x-section-border />
    </div>
</x-authentication-card>
</x-app-layout>
@include('layouts.footer')


