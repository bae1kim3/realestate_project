<x-guest-layout>
    <x-authentication-card>
        <x-slot name="header">
            {{ __('사용자 라이센스 확인') }}
        </x-slot>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4">
            @if(isset($message))
                <div>{{ $message }}</div>
                    <x-button id="btn3">확인</x-button>
            @elseif(isset($error_message))
                <div class="text-red-500">{{ $error_message }}</div>
                    <x-button id="btn3">확인</x-button>
            @endif
        </div>
    </x-authentication-card>
</x-guest-layout>

<script>
    const btn3 = document.getElementById("btn3");
    btn3.addEventListener("click", () => {
        window.close();
    });
</script>





