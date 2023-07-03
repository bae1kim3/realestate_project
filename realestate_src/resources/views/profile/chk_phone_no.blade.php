<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('프로필') }}
        </h2>
    </x-slot>
    <div>
        <x-authentication-card>

        <x-slot name="logo">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
                <img src="{{ asset('logo.jpg') }}" alt="" style="width: 150px; height:150px">
            </h1>
        </x-slot>

        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    <form action="{{ route('up_pass') }}" method="post" id="checkPhoneForm">
                        @csrf
                        <label for="phone_no" class="block font-medium text-sm text-gray-700 mt-3 dark:text-white">전화번호 확인</label>
                        <x-input type="tel" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" id="phone_no" name="phone_no"></x-input><br>
                        <x-button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-gray-600">확인</x-button>
                    </form>
                    </form>
                    @if ($errors->has('phone_no'))
                        <div class="text-red-500">
                            {{ $errors->first('phone_no') }}
                        </div>
                    @endif
                </div>
                <x-section-border />
            @endif

        </div>
    </div>
</x-authentication-card>

</x-app-layout>
