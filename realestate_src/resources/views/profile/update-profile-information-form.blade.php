<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <h2 class="dark:text-white">
        {{ __('Profile Information') }}
        </h2>
    </x-slot>

    <x-slot name="description">
        <h4 class="dark:text-white">
        {{ __('Update your account\'s profile information and email address.') }}
        </h4>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" class="dark:text-white"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover dark:bg-gray-700 dark:text-white">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2 dark:bg-gray-700 dark:text-white" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2 dark:bg-gray-700 dark:text-white" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}"/>
            <x-input id="name" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.name" readonly autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        {{-- id --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="id" value="{{ __('ID') }}" />
            <x-input id="id" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.u_id" readonly autocomplete="ID" />
            <x-input-error for="id" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />
        </div>

        {{-- phone number --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone_no" value="{{ __('Phone number') }}" />
            <x-input id="phone_no" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.phone_no" autocomplete="phone_number" />
            <x-input-error for="phone_no" class="mt-2" />
        </div>

        {{-- user address --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="u_addr" value="{{ __('Address') }}" />
            <x-input id="u_addr" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.u_addr" autocomplete="u_addr" />
            <x-input-error for="u_addr" class="mt-2" />
        </div>
        
        @if(Illuminate\Support\Facades\Auth::user()->seller_license)
        {{-- seller license --}}
            <div class="col-span-6 sm:col-span-4">
            <x-label for="seller_license" value="{{ __('Seller license') }}" />
            <x-input id="seller_license" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.seller_license" readonly autocomplete="seller_license" />
            <x-input-error for="seller_license" class="mt-2" />
        </div>

        {{-- business name --}}
            <div class="col-span-6 sm:col-span-4">
            <x-label for="b_name" value="{{ __('Business name') }}" />
            <x-input id="b_name" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.b_name" autocomplete="b_name" />
            <x-input-error for="b_name" class="mt-2" />
        </div>
        @endif

        @if(!(Illuminate\Support\Facades\Auth::user()->seller_license))
            {{-- animal size --}}
            <div class="col-span-6 sm:col-span-4">
            <x-label for="animal_size" value="{{ __('Animal size') }}" />
            {{-- <x-input id="animal_size" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-white" wire:model.defer="state.animal_size" autocomplete="animal_size" /> --}}
            <x-label for="animal_size" value="{{ __('대형 동물') }}" class="dark:text-white"/>
            <input type="checkbox" id="animal_size" @if(Illuminate\Support\Facades\Auth::user()->animal_size === "1") checked @endif value="1" name="animal_size" class="dark:bg-gray-700">
        </div>
        @endif



            {{-- @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-white" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif --}}
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
