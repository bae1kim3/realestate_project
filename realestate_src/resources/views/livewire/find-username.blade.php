<x-authentication-card>
    <x-slot name="logo">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100">
            {{ __('아이디 찾기') }}
        </h1>
    </x-slot>

    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <form wire:submit.prevent="findUsername">
            <x-label for="email" class="block dark:text-white">{{ __('이메일') }}</x-label>
            <x-input type="email" wire:model="email" placeholder="이메일 입력"
                class="block mt-1 w-full dark:bg-gray-700 dark:text-white"></x-input>
            <br>
            <x-button class="dark:bg-gray-400" id="btn2">아이디 찾기</x-button>

            @if (Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
        </form>
    </div>
</x-authentication-card>

{{-- <script src="{{ asset('test.js') }}"></script> --}}

<script>
    let newWindow = null;
    const btn2 = document.getElementById("btn2");

    btn2.addEventListener("click", () => {
        newWindow = window.open("{{ route('notice-username') }}", "find", "width=800,height=500");
        location.href = "{{ route('login') }}";
    });
</script>
