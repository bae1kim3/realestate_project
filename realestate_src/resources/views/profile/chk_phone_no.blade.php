<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    <form action="{{ route('up_pass') }}" method="post" id="checkPhoneForm">
                        @csrf
                        @method('post')
                        <input type="tel" id="phone_no" name="phone_no">
                        <button type="submit">Check</button>
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
</x-app-layout>
