@props(['href', 'active' => false])

<a href="{{ $href }}" {{ $attributes->merge(['class' => $active ? 'text-gray-900' : 'text-gray-500']) }}>
    {{ $slot }}
</a>
