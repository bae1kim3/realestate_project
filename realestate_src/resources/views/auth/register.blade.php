<x-guest-layout>
    <x-authentication-card>
        <x-slot name="header">
            {{ __('Select') }}
        </x-slot>
        <x-slot name="logo">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                {{ __('Select Register') }}
            </h1>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

            @csrf
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('user-register') }}"><x-button style="margin:50px" class="dark:bg-gray-600">
                        {{ __('User_Register') }}
                    </x-button></a>

                    <a href="{{ route('seller-register') }}"><x-button style="margin:10px" class="dark:bg-gray-600">
                        {{ __('Seller_Register') }}
                    </x-button></a>
                </div>
            </div>
    </x-authentication-card>
</x-guest-layout>
