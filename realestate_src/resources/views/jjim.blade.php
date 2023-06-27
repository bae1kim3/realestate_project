<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
        </x-slot>


    </x-authentication-card>
</x-app-layout>
<script>
    @if (session('message'))
        alert("{{ session('message') }}");
    @endif
</script>
