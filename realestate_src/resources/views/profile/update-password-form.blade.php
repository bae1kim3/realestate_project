<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('비밀번호 변경') }}
    </x-slot>

    <x-slot name="description">
        {{ __('비밀번호는 대문자, 소문자, 숫자, 특수문자 모두 최소 하나씩을 포함하고, 최소 8자 최대 20자로 변경해주세요') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('현재 비밀번호') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('새 비밀번호') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('비밀번호 확인') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('변경됨') }}
        </x-action-message>

        <x-button>
            {{ __('저장') }}
        </x-button>
    </x-slot>
</x-form-section>
