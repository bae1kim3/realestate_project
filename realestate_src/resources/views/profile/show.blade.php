<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 dark:bg-gray-900">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0 dark:text-white">
                    <h1 style="margin-left:40%">If you wannt change password?</h1>
                    <br>
                    <x-button style="margin-left:40%"><div><a href="{{ route('profile.chk_phone_no') }}">Update Password</a></div></x-button>
                </div>

                <x-section-border />
            @endif

            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div> --}}

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                {{--@livewire('profile.delete-user-form')--}}
                    <h1 style="margin-left:40%">Delete account</h1>
                    <p style="margin-left:40%">
                        Permanently delete your account.
                    <p>
                    <br>
                    <x-danger-button style="margin-left:40%">
                        <a href="{{ route('profile.chk_del_user') }}">Delete account</a>
                    </x-danger-button>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
